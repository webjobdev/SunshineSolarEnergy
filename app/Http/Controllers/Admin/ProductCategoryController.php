<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\ProductCategoryStoreRequest;
use App\Http\Requests\Admin\Product\ProductCategoryUpdateRequest;
use App\Models\Admin\ProductCategory;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of product categories.
     *
     * @method GET
     * @url admin/product/category
     * @name admin.product.category
     *
     * @param Request $request
     * @return View|array
     */
    public function index(Request $request): View|array
    {
        try {
            $categories = ProductCategory::withCount('products')->latest()->paginate(15);
            return view('admin.pages.product.category.index', compact('categories'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new product category.
     *
     * @method GET
     * @url admin/product/category/create
     * @name admin.product.category.create
     *
     * @return View|array
     */
    public function create(): View|array
    {
        try {
            return view('admin.pages.product.category.create');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Store a newly created product category in storage.
     *
     * @method POST
     * @url admin/product/category
     * @name admin.product.category.store
     *
     * @param ProductCategoryStoreRequest $request
     * @return RedirectResponse|array
     */
    public function store(ProductCategoryStoreRequest $request): RedirectResponse|array
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('product/categories', 'public');
                $data['image'] = $path;
            }

            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['name']);
            }

            $data['created_by'] = auth()->id();
            $data['updated_by'] = auth()->id();

            ProductCategory::create($data);

            return redirect()->route('admin.product.category')
                ->with('success', 'Category created successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified product category.
     *
     * @method GET
     * @url admin/product/category/edit/{id}
     * @name admin.product.category.edit
     *
     * @param int $id
     * @return View|array
     */
    public function edit(int $id): View|array
    {
        try {
            $category = ProductCategory::findOrFail($id);
            return view('admin.pages.product.category.edit', compact('category'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Update the specified product category in storage.
     *
     * @method PUT|PATCH
     * @url admin/product/category/update/{id}
     * @name admin.product.category.update
     *
     * @param ProductCategoryUpdateRequest $request
     * @param int $id
     * @return RedirectResponse|array
     */
    public function update(ProductCategoryUpdateRequest $request, int $id): RedirectResponse|array
    {
        try {
            $category = ProductCategory::findOrFail($id);
            $data = $request->validated();

            if ($request->hasFile('image')) {
                if ($category->image && Storage::disk('public')->exists($category->image)) {
                    Storage::disk('public')->delete($category->image);
                }
                $path = $request->file('image')->store('product/categories', 'public');
                $data['image'] = $path;
            }

            $data['updated_by'] = auth()->id();

            $category->update($data);

            return redirect()->route('admin.product.category')
                ->with('success', 'Category updated successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Remove the specified product category from storage.
     *
     * @method DELETE
     * @url admin/product/category/delete/{id}
     * @name admin.product.category.delete
     *
     * @param int $id
     * @return JsonResponse|array
     */
    public function destroy(int $id): JsonResponse|array
    {
        try {
            $category = ProductCategory::findOrFail($id);

            if ($category->products()->count() > 0) {
                return errorResponse('Cannot delete category with associated products.');
            }

            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
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
     * @url admin/product/category/generate-slug
     * @name admin.product.category.generate-slug
     *
     * @param Request $request
     * @return JsonResponse|array
     */
    public function generateSlug(Request $request): JsonResponse|array
    {
        try {
            $name = $request->input('name');
            $slug = Str::slug($name);
            $count = ProductCategory::where('slug', $slug)->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
            return response()->json(['status' => true, 'slug' => $slug]);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }
}