<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\BlogCategoryStoreRequest;
use App\Http\Requests\Admin\Blog\BlogCategoryUpdateRequest;
use App\Models\Admin\BlogCategory;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of blog categories.
     *
     * @method GET
     * @url admin/blog/category
     * @name admin.blog.category
     *
     * @param Request $request
     * @return View|array
     */
    public function index(Request $request): View|array
    {
        try {
            $categories = BlogCategory::withCount('blogs')->latest()->paginate(15);
            return view('admin.pages.blog.category.index', compact('categories'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new blog category.
     *
     * @method GET
     * @url admin/blog/category/create
     * @name admin.blog.category.create
     *
     * @return View|array
     */
    public function create(): View|array
    {
        try {
            return view('admin.pages.blog.category.create');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Store a newly created blog category in storage.
     *
     * @method POST
     * @url admin/blog/category
     * @name admin.blog.category.store
     *
     * @param BlogCategoryStoreRequest $request
     * @return RedirectResponse|array
     */
    public function store(BlogCategoryStoreRequest $request): RedirectResponse|array
    {
        try {
            $data = $request->validated();

            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['name']);
            }

            $data['created_by'] = auth()->id();
            $data['updated_by'] = auth()->id();

            BlogCategory::create($data);

            return redirect()->route('admin.blog.category')
                ->with('success', 'Category created successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified blog category.
     *
     * @method GET
     * @url admin/blog/category/edit/{id}
     * @name admin.blog.category.edit
     *
     * @param int $id
     * @return View|array
     */
    public function edit(int $id): View|array
    {
        try {
            $category = BlogCategory::findOrFail($id);
            return view('admin.pages.blog.category.edit', compact('category'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Update the specified blog category in storage.
     *
     * @method PUT|PATCH
     * @url admin/blog/category/update/{id}
     * @name admin.blog.category.update
     *
     * @param BlogCategoryUpdateRequest $request
     * @param int $id
     * @return RedirectResponse|array
     */
    public function update(BlogCategoryUpdateRequest $request, int $id): RedirectResponse|array
    {
        try {
            $category = BlogCategory::findOrFail($id);
            $data = $request->validated();

            $data['updated_by'] = auth()->id();

            $category->update($data);

            return redirect()->route('admin.blog.category')
                ->with('success', 'Category updated successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }
    /**
     * Remove the specified blog category from storage.
     *
     * @method DELETE
     * @url admin/blog/category/delete/{id}
     * @name admin.blog.category.delete
     *
     * @param int $id
     * @return JsonResponse|array
     */
    public function destroy(int $id): JsonResponse|array
    {
        try {
            $category = BlogCategory::findOrFail($id);

            if ($category->blogs()->count() > 0) {
                return errorResponse('Cannot delete category with associated blogs.');
            }

            $category->delete();

            return response()->json(['status' => true, 'message' => 'Category deleted successfully.']);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Generate a URL-friendly slug from the category name.
     *
     * @method POST
     * @url admin/blog/category/generate-slug
     * @name admin.blog.category.generate-slug
     *
     * @param Request $request
     * @return JsonResponse|array
     */
    public function generateSlug(Request $request): JsonResponse|array
    {
        try {
            $name = $request->input('name');
            $slug = Str::slug($name);
            $count = BlogCategory::where('slug', $slug)->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
            return response()->json(['status' => true, 'slug' => $slug]);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }
}
