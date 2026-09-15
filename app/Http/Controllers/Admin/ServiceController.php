<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Service\ServiceStoreRequest;
use App\Http\Requests\Admin\Service\ServiceUpdateRequest;
use App\Models\Admin\Service;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     *
     * @method GET
     * @url admin/service
     * @name admin.service
     *
     * @param Request $request
     * @return View|array
     */
    public function index(Request $request): View|array
    {
        try {
            $services = Service::with('createdBy')->latest()->paginate(15);
            return view('admin.pages.service.index', compact('services'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new service.
     *
     * @method GET
     * @url admin/service/create
     * @name admin.service.create
     *
     * @return View|array
     */
    public function create(): View|array
    {
        try {
            return view('admin.pages.service.create');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Store a newly created service in storage.
     *
     * @method POST
     * @url admin/service
     * @name admin.service.store
     *
     * @param ServiceStoreRequest $request
     * @return RedirectResponse|array
     */
    public function store(ServiceStoreRequest $request): RedirectResponse|array
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $path = $request->file('thumbnail')->store('service/thumbnails', 'public');
                $data['thumbnail'] = $path;
            }

            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['name']);
            }

            $data['sort_order'] = $data['sort_order'] ?? 0;
            $data['created_by'] = auth()->id();
            $data['updated_by'] = auth()->id();

            Service::create($data);

            return redirect()->route('admin.service')
                ->with('success', 'Service created successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified service.
     *
     * @method GET
     * @url admin/service/edit/{id}
     * @name admin.service.edit
     *
     * @param int $id
     * @return View|array
     */
    public function edit(int $id): View|array
    {
        try {
            $service = Service::findOrFail($id);
            return view('admin.pages.service.edit', compact('service'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Update the specified service in storage.
     *
     * @method PUT|PATCH
     * @url admin/service/update/{id}
     * @name admin.service.update
     *
     * @param ServiceUpdateRequest $request
     * @param int $id
     * @return RedirectResponse|array
     */
    public function update(ServiceUpdateRequest $request, int $id): RedirectResponse|array
    {
        try {
            $service = Service::findOrFail($id);
            $data = $request->validated();

            if ($request->hasFile('thumbnail')) {
                if ($service->thumbnail && Storage::disk('public')->exists($service->thumbnail)) {
                    Storage::disk('public')->delete($service->thumbnail);
                }
                $path = $request->file('thumbnail')->store('service/thumbnails', 'public');
                $data['thumbnail'] = $path;
            }
            $data['sort_order'] = $data['sort_order'] ?? 0;
            $data['updated_by'] = auth()->id();

            $service->update($data);

            return redirect()->route('admin.service')
                ->with('success', 'Service updated successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Remove the specified service from storage.
     *
     * @method DELETE
     * @url admin/service/delete/{id}
     * @name admin.service.delete
     *
     * @param int $id
     * @return JsonResponse|array
     */
    public function destroy(int $id): JsonResponse|array
    {
        try {
            $service = Service::findOrFail($id);

            if ($service->thumbnail && Storage::disk('public')->exists($service->thumbnail)) {
                Storage::disk('public')->delete($service->thumbnail);
            }

            $service->delete();

            return response()->json(['status' => true, 'message' => 'Service deleted successfully.']);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Generate a URL-friendly slug from the service name.
     *
     * @method POST
     * @url admin/service/generate-slug
     * @name admin.service.generate-slug
     *
     * @param Request $request
     * @return JsonResponse|array
     */
    public function generateSlug(Request $request): JsonResponse|array
    {
        try {
            $name = $request->input('name');
            $slug = Str::slug($name);
            $count = Service::where('slug', $slug)->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
            return response()->json(['status' => true, 'slug' => $slug]);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }
}