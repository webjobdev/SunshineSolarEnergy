<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\ProductStoreRequest;
use App\Http\Requests\Admin\Product\ProductUpdateRequest;
use App\Models\Admin\Product;
use App\Models\Admin\ProductBrand;
use App\Models\Admin\ProductCategory;
use App\Models\Admin\ProductGallery;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     *
     * @method GET
     * @url admin/product
     * @name admin.product
     *
     * @param Request $request
     * @return View|array
     */
    public function index(Request $request): View|array
    {
        try {
            $products = Product::with(['brand', 'category', 'createdBy'])->latest()->paginate(15);
            return view('admin.pages.product.index', compact('products'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new product.
     *
     * @method GET
     * @url admin/product/create
     * @name admin.product.create
     *
     * @return View|array
     */
    public function create(): View|array
    {
        try {
            $brands = ProductBrand::where('status', 'active')->orderBy('sort_order')->get();
            $categories = ProductCategory::where('status', 'active')->orderBy('sort_order')->get();
            return view('admin.pages.product.create', compact('brands', 'categories'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Store a newly created product in storage.
     *
     * @method POST
     * @url admin/product
     * @name admin.product.store
     *
     * @param ProductStoreRequest $request
     * @return RedirectResponse|array
     */
    public function store(ProductStoreRequest $request): RedirectResponse|array
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $path = $request->file('thumbnail')->store('product/thumbnails', 'public');
                $data['thumbnail'] = $path;
            }

            $data['sort_order'] = $data['sort_order'] ?? 0;

            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['name']);
            }

            $data['created_by'] = auth()->id();
            $data['updated_by'] = auth()->id();

            $galleries = $data['galleries'] ?? [];
            unset($data['galleries']);

            $product = Product::create($data);

            if (!empty($galleries)) {
                foreach ($galleries as $galleryImage) {
                    $path = $galleryImage->store('product/galleries', 'public');
                    ProductGallery::create([
                        'product_id' => $product->id,
                        'image' => $path,
                    ]);
                }
            }

            return redirect()->route('admin.product')
                ->with('success', 'Product created successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified product.
     *
     * @method GET
     * @url admin/product/edit/{id}
     * @name admin.product.edit
     *
     * @param int $id
     * @return View|array
     */
    public function edit(int $id): View|array
    {
        try {
            $product = Product::with(['brand', 'category', 'galleries'])->findOrFail($id);
            $brands = ProductBrand::where('status', 'active')->orderBy('sort_order')->get();
            $categories = ProductCategory::where('status', 'active')->orderBy('sort_order')->get();
            return view('admin.pages.product.edit', compact('product', 'brands', 'categories'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Update the specified product in storage.
     *
     * @method PUT|PATCH
     * @url admin/product/update/{id}
     * @name admin.product.update
     *
     * @param ProductUpdateRequest $request
     * @param int $id
     * @return RedirectResponse|array
     */
    public function update(ProductUpdateRequest $request, int $id): RedirectResponse|array
    {
        try {
            $product = Product::findOrFail($id);
            $data = $request->validated();

            if ($request->hasFile('thumbnail')) {
                if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
                    Storage::disk('public')->delete($product->thumbnail);
                }
                $path = $request->file('thumbnail')->store('product/thumbnails', 'public');
                $data['thumbnail'] = $path;
            }

            $data['updated_by'] = auth()->id();
            $data['sort_order'] = $data['sort_order'] ?? 0;

            $galleries = $data['galleries'] ?? [];
            unset($data['galleries']);

            $removeGalleries = $data['remove_galleries'] ?? [];
            unset($data['remove_galleries']);

            if (!empty($removeGalleries)) {
                foreach ($removeGalleries as $galleryId) {
                    $gallery = ProductGallery::where('id', $galleryId)->where('product_id', $product->id)->first();
                    if ($gallery) {
                        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                            Storage::disk('public')->delete($gallery->image);
                        }
                        $gallery->delete();
                    }
                }
            }

            $product->update($data);

            if (!empty($galleries)) {
                foreach ($galleries as $galleryImage) {
                    $path = $galleryImage->store('product/galleries', 'public');
                    ProductGallery::create([
                        'product_id' => $product->id,
                        'image' => $path,
                    ]);
                }
            }

            return redirect()->route('admin.product')
                ->with('success', 'Product updated successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Remove the specified product from storage.
     *
     * @method DELETE
     * @url admin/product/delete/{id}
     * @name admin.product.delete
     *
     * @param int $id
     * @return JsonResponse|array
     */
    public function destroy(int $id): JsonResponse|array
    {
        try {
            $product = Product::with('galleries')->findOrFail($id);

            if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
                Storage::disk('public')->delete($product->thumbnail);
            }

            foreach ($product->galleries as $gallery) {
                if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                    Storage::disk('public')->delete($gallery->image);
                }
                $gallery->delete();
            }

            $product->delete();

            return response()->json(['status' => true, 'message' => 'Product deleted successfully.']);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Generate a URL-friendly slug from the product name.
     *
     * @method POST
     * @url admin/product/generate-slug
     * @name admin.product.generate-slug
     *
     * @param Request $request
     * @return JsonResponse|array
     */
    public function generateSlug(Request $request): JsonResponse|array
    {
        try {
            $name = $request->input('name');
            $slug = Str::slug($name);
            $count = Product::where('slug', $slug)->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
            return response()->json(['status' => true, 'slug' => $slug]);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }
}