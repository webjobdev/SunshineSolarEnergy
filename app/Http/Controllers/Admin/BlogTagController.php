<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\BlogTagStoreRequest;
use App\Http\Requests\Admin\Blog\BlogTagUpdateRequest;
use App\Models\Admin\BlogTag;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogTagController extends Controller
{
    /**
     * Display a listing of blog tags.
     *
     * @method GET
     * @url admin/blog/tag
     * @name admin.blog.tag
     *
     * @param Request $request
     * @return View|array
     */
    public function index(Request $request): View|array
    {
        try {
            $tags = BlogTag::withCount('blogs')->latest()->paginate(15);
            return view('admin.pages.blog.tag.index', compact('tags'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new blog tag.
     *
     * @method GET
     * @url admin/blog/tag/create
     * @name admin.blog.tag.create
     *
     * @return View|array
     */
    public function create(): View|array
    {
        try {
            return view('admin.pages.blog.tag.create');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Store a newly created blog tag in storage.
     *
     * @method POST
     * @url admin/blog/tag
     * @name admin.blog.tag.store
     *
     * @param BlogTagStoreRequest $request
     * @return RedirectResponse|array
     */
    public function store(BlogTagStoreRequest $request): RedirectResponse|array
    {
        try {
            $data = $request->validated();
            
            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['name']);
            }
            
            $data['created_by'] = auth()->id();
            $data['updated_by'] = auth()->id();
            
            BlogTag::create($data);
            
            return redirect()->route('admin.blog.tag')
                ->with('success', 'Tag created successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified blog tag.
     *
     * @method GET
     * @url admin/blog/tag/edit/{id}
     * @name admin.blog.tag.edit
     *
     * @param int $id
     * @return View|array
     */
    public function edit(int $id): View|array
    {
        try {
            $tag = BlogTag::findOrFail($id);
            return view('admin.pages.blog.tag.edit', compact('tag'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Update the specified blog tag in storage.
     *
     * @method PUT|PATCH
     * @url admin/blog/tag/update/{id}
     * @name admin.blog.tag.update
     *
     * @param BlogTagUpdateRequest $request
     * @param int $id
     * @return RedirectResponse|array
     */
    public function update(BlogTagUpdateRequest $request, int $id): RedirectResponse|array
    {
        try {
            $tag = BlogTag::findOrFail($id);
            $data = $request->validated();
            
            $data['updated_by'] = auth()->id();
            
            $tag->update($data);
            
            return redirect()->route('admin.blog.tag')
                ->with('success', 'Tag updated successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Remove the specified blog tag from storage.
     *
     * @method DELETE
     * @url admin/blog/tag/delete/{id}
     * @name admin.blog.tag.delete
     *
     * @param int $id
     * @return JsonResponse|array
     */
    public function destroy(int $id): JsonResponse|array
    {
        try {
            $tag = BlogTag::findOrFail($id);
            
            if ($tag->blogs()->count() > 0) {
                return errorResponse('Cannot delete tag with associated blogs.');
            }
            
            $tag->delete();
            
            return response()->json(['status' => true, 'message' => 'Tag deleted successfully.']);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Generate a URL-friendly slug from the tag name.
     *
     * @method POST
     * @url admin/blog/tag/generate-slug
     * @name admin.blog.tag.generate-slug
     *
     * @param Request $request
     * @return JsonResponse|array
     */
    public function generateSlug(Request $request): JsonResponse|array
    {
        try {
            $name = $request->input('name');
            $slug = Str::slug($name);
            $count = BlogTag::where('slug', $slug)->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
            return response()->json(['status' => true, 'slug' => $slug]);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }
}