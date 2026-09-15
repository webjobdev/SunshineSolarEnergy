<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\ProductBrandStoreRequest;
use App\Http\Requests\Admin\Product\ProductBrandUpdateRequest;
use App\Models\Admin\ProductBrand;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductBrandController extends Controller
{
    /**
     * Display a listing of product brands.
     *
     * @method GET
     * @url admin/product/brand
     * @name admin.product.brand
     *
     * @param Request $request
     * @return View|array
     */
    public function index(Request $request): View|array
    {
        try {
            $brands = ProductBrand::withCount('products')->latest()->paginate(15);
            return view('admin.pages.product.brand.index', compact('brands'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new product brand.
     *
     * @method GET
     * @url admin/product/brand/create
     * @name admin.product.brand.create
     *
     * @return View|array
     */
    public function create(): View|array
    {
        try {
            return view('admin.pages.product.brand.create');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Store a newly created product brand in storage.
     *
     * @method POST
     * @url admin/product/brand
     * @name admin.product.brand.store
     *
     * @param ProductBrandStoreRequest $request
     * @return RedirectResponse|array
     */
    public function store(ProductBrandStoreRequest $request): RedirectResponse|array
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('product/brands', 'public');
                $data['image'] = $path;
            }

            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['name']);
            }

            $data['created_by'] = auth()->id();
            $data['updated_by'] = auth()->id();

            ProductBrand::create($data);

            return redirect()->route('admin.product.brand')
                ->with('success', 'Brand created successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified product brand.
     *
     * @method GET
     * @url admin/product/brand/edit/{id}
     * @name admin.product.brand.edit
     *
     * @param int $id
     * @return View|array
     */
    public function edit(int $id): View|array
    {
        try {
            $brand = ProductBrand::findOrFail($id);
            return view('admin.pages.product.brand.edit', compact('brand'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Update the specified product brand in storage.
     *
     * @method PUT|PATCH
     * @url admin/product/brand/update/{id}
     * @name admin.product.brand.update
     *
     * @param ProductBrandUpdateRequest $request
     * @param int $id
     * @return RedirectResponse|array
     */
    public function update(ProductBrandUpdateRequest $request, int $id): RedirectResponse|array
    {
        try {
            $brand = ProductBrand::findOrFail($id);
            $data = $request->validated();

            if ($request->hasFile('image')) {
                if ($brand->image && Storage::disk('public')->exists($brand->image)) {
                    Storage::disk('public')->delete($brand->image);
                }
                $path = $request->file('image')->store('product/brands', 'public');
                $data['image'] = $path;
            }

            $data['updated_by'] = auth()->id();

            $brand->update($data);

            return redirect()->route('admin.product.brand')
                ->with('success', 'Brand updated successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Remove the specified product brand from storage.
     *
     * @method DELETE
     * @url admin/product/brand/delete/{id}
     * @name admin.product.brand.delete
     *
     * @param int $id
     * @return JsonResponse|array
     */
    public function destroy(int $id): JsonResponse|array
    {
        try {
            $brand = ProductBrand::findOrFail($id);

            if ($brand->products()->count() > 0) {
                return errorResponse('Cannot delete brand with associated products.');
            }

            if ($brand->image && Storage::disk('public')->exists($brand->image)) {
                Storage::disk('public')->delete($brand->image);
            }

            $brand->delete();

            return response()->json(['status' => true, 'message' => 'Brand deleted successfully.']);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Generate a URL-friendly slug from the brand name.
     *
     * @method POST
     * @url admin/product/brand/generate-slug
     * @name admin.product.brand.generate-slug
     *
     * @param Request $request
     * @return JsonResponse|array
     */
    public function generateSlug(Request $request): JsonResponse|array
    {
        try {
            $name = $request->input('name');
            $slug = Str::slug($name);
            $count = ProductBrand::where('slug', $slug)->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
            return response()->json(['status' => true, 'slug' => $slug]);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }
}