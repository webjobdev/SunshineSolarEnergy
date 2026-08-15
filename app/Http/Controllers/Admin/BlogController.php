<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\BlogStoreRequest;
use App\Http\Requests\Admin\Blog\BlogUpdateRequest;
use App\Models\Admin\Blog;
use App\Models\Admin\BlogCategory;
use App\Models\Admin\BlogTag;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts.
     *
     * @method GET
     * @url admin/blog
     * @name admin.blog
     *
     * @param Request $request
     * @return View|array
     */
    public function index(Request $request): View|array
    {
        try {
            $blogs = Blog::with(['category', 'createdBy'])->latest()->paginate(15);
            return view('admin.pages.blog.index', compact('blogs'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new blog post.
     *
     * @method GET
     * @url admin/blog/create
     * @name admin.blog.create
     *
     * @return View|array
     */
    public function create(): View|array
    {
        try {
            $categories = BlogCategory::where('status', 'active')->get();
            $tags = BlogTag::where('status', 'active')->get();
            $robotsOptions = [
                'index,follow' => 'Index, Follow',
                'index,nofollow' => 'Index, NoFollow',
                'noindex,follow' => 'NoIndex, Follow',
                'noindex,nofollow' => 'NoIndex, NoFollow',
            ];
            return view('admin.pages.blog.create', compact('categories', 'tags', 'robotsOptions'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Store a newly created blog post in storage.
     *
     * @method POST
     * @url admin/blog
     * @name admin.blog.store
     *
     * @param BlogStoreRequest $request
     * @return RedirectResponse|array
     */
    public function store(BlogStoreRequest $request): RedirectResponse|array
    {
        try {
            $data = $request->validated();

            // Handle featured image
            if ($request->hasFile('featured_image')) {
                $path = $request->file('featured_image')->store('blog/images', 'public');
                $data['featured_image'] = $path;
            }

            // Set audit fields
            $data['created_by'] = auth()->id();
            $data['updated_by'] = auth()->id();

            // Generate slug if not provided
            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['title']);
            }

            // Set default robots if not provided
            if (empty($data['robots'])) {
                $data['robots'] = 'index,follow';
            }

            // Set published_at if status is published
            if ($data['status'] === 'published' && empty($data['published_at'])) {
                $data['published_at'] = now();
            }

            // Remove tags from data array before creating (tags handled separately)
            $tags = $data['tags'] ?? [];
            unset($data['tags']);

            // Create blog
            $blog = Blog::create($data);

            // Sync tags
            if (!empty($tags)) {
                $blog->tags()->sync($tags);
            }

            return redirect()->route('admin.blog')
                ->with('success', 'Blog created successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified blog post.
     *
     * @method GET
     * @url admin/blog/edit/{id}
     * @name admin.blog.edit
     *
     * @param int $id
     * @return View|array
     */
    public function edit(int $id): View|array
    {
        try {
            $blog = Blog::with(['category', 'tags'])->findOrFail($id);
            $categories = BlogCategory::where('status', 'active')->get();
            $tags = BlogTag::where('status', 'active')->get();
            $robotsOptions = [
                'index,follow' => 'Index, Follow',
                'index,nofollow' => 'Index, NoFollow',
                'noindex,follow' => 'NoIndex, Follow',
                'noindex,nofollow' => 'NoIndex, NoFollow',
            ];
            $selectedTags = $blog->tags->pluck('id')->toArray();

            return view('admin.pages.blog.edit', compact('blog', 'categories', 'tags', 'robotsOptions', 'selectedTags'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Update the specified blog post in storage.
     *
     * @method PUT|PATCH
     * @url admin/blog/update/{id}
     * @name admin.blog.update
     *
     * @param BlogUpdateRequest $request
     * @param int $id
     * @return RedirectResponse|array
     */
    public function update(BlogUpdateRequest $request, int $id): RedirectResponse|array
    {
        try {
            $blog = Blog::findOrFail($id);
            $data = $request->validated();

            // Handle featured image upload
            if ($request->hasFile('featured_image')) {
                // Delete old image
                if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
                    Storage::disk('public')->delete($blog->featured_image);
                }
                $path = $request->file('featured_image')->store('blog/images', 'public');
                $data['featured_image'] = $path;
            }

            // Handle remove image checkbox
            if ($request->has('remove_image') && $request->input('remove_image') == 1) {
                if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
                    Storage::disk('public')->delete($blog->featured_image);
                }
                $data['featured_image'] = null;
            }

            // Remove remove_image from data array (not a database column)
            unset($data['remove_image']);

            // Set audit fields
            $data['updated_by'] = auth()->id();

            // Set default robots if not provided
            if (empty($data['robots'])) {
                $data['robots'] = 'index,follow';
            }

            // Set published_at if status is published and not already set
            if ($data['status'] === 'published' && empty($data['published_at']) && empty($blog->published_at)) {
                $data['published_at'] = now();
            }

            // Remove tags from data array before updating (tags handled separately)
            $tags = $data['tags'] ?? [];
            unset($data['tags']);

            // Update blog
            $blog->update($data);

            // Sync tags
            if (isset($tags)) {
                $blog->tags()->sync($tags);
            }

            return redirect()->route('admin.blog')
                ->with('success', 'Blog updated successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Remove the specified blog post from storage.
     *
     * @method DELETE
     * @url admin/blog/delete/{id}
     * @name admin.blog.delete
     *
     * @param int $id
     * @return JsonResponse|array
     */
    public function destroy(int $id): JsonResponse|array
    {
        try {
            $blog = Blog::findOrFail($id);

            // Delete featured image
            if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
                Storage::disk('public')->delete($blog->featured_image);
            }

            // Detach tags
            $blog->tags()->detach();

            $blog->delete();

            return response()->json(['status' => true, 'message' => 'Blog deleted successfully.']);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Generate a URL-friendly slug from the blog title.
     *
     * @method POST
     * @url admin/blog/generate-slug
     * @name admin.blog.generate-slug
     *
     * @param Request $request
     * @return JsonResponse|array
     */
    public function generateSlug(Request $request): JsonResponse|array
    {
        try {
            $title = $request->input('title');
            $slug = Str::slug($title);
            $count = Blog::where('slug', $slug)->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
            return response()->json(['status' => true, 'slug' => $slug]);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Toggle the status of the specified blog post.
     *
     * @method POST
     * @url admin/blog/toggle-status/{id}
     * @name admin.blog.toggle-status
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse|array
     */
    public function toggleStatus(Request $request, int $id): JsonResponse|array
    {
        try {
            $blog = Blog::findOrFail($id);
            $blog->status = $request->input('status', 'draft');

            if ($blog->status === 'published' && empty($blog->published_at)) {
                $blog->published_at = now();
            }

            $blog->save();

            return response()->json(['status' => true, 'message' => 'Status updated successfully.']);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Display the specified blog post.
     *
     * @method GET
     * @url admin/blog/show/{id}
     * @name admin.blog.show
     *
     * @param int $id
     * @return View|array
     */
    public function show(int $id): View|array
    {
        try {
            $blog = Blog::with(['category', 'tags', 'createdBy'])->findOrFail($id);
            return view('admin.pages.blog.show', compact('blog'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }
}