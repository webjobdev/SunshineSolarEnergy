<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WebsiteConfig\ConfigImageRequest;
use App\Http\Requests\Admin\WebsiteConfig\ConfigStoreRequest;
use App\Http\Requests\Admin\WebsiteConfig\ConfigUpdateRequest;
use App\Models\Admin\WebsiteConfiguration;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WebsiteConfigController extends Controller
{
    /**
     * Configuration groups for display.
     *
     * @var array
     */
    protected array $configGroups = [
        'general' => 'General Settings',
        'contact' => 'Contact Information',
        'social' => 'Social Media Links',
        'seo' => 'SEO Settings',
        'header' => 'Header Settings',
        'footer' => 'Footer Settings',
        'system' => 'System Settings',
        'design' => 'Design Settings',
    ];

    /**
     * Display a listing of configurations.
     *
     * @method GET
     * @url admin/config
     * @name admin.config
     *
     * @param Request $request
     * @return View|array
     */
    public function index(Request $request): View|array
    {
        try {
            $group = $request->input('group', 'general');
            $configurations = WebsiteConfiguration::where('config_group', $group)
                ->orderBy('sort_order')
                ->get();
            
            return view('admin.pages.config.index', [
                'configurations' => $configurations,
                'currentGroup' => $group,
                'configGroups' => $this->configGroups,
            ]);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new configuration.
     *
     * @method GET
     * @url admin/config/create
     * @name admin.config.create
     *
     * @return View|array
     */
    public function create(): View|array
    {
        try {
            $configTypes = [
                'text' => 'Text',
                'textarea' => 'Textarea',
                'image' => 'Image',
                'file' => 'File',
                'boolean' => 'Boolean (Yes/No)',
                'number' => 'Number',
                'json' => 'JSON',
                'email' => 'Email',
                'color' => 'Color',
                'url' => 'URL',
            ];

            return view('admin.pages.config.create', [
                'configGroups' => $this->configGroups,
                'configTypes' => $configTypes,
            ]);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Store a newly created configuration in storage.
     *
     * @method POST
     * @url admin/config
     * @name admin.config.store
     *
     * @param ConfigStoreRequest $request
     * @return RedirectResponse|array
     */
    public function store(ConfigStoreRequest $request): RedirectResponse|array
    {
        try {
            $data = $request->validated();
            
            $data['created_by'] = auth()->id();
            $data['updated_by'] = auth()->id();
            
            WebsiteConfiguration::create($data);
            
            clearConfigCache();
            
            return redirect()->route('admin.config', ['group' => $data['config_group']])
                ->with('success', 'Configuration created successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified configuration.
     *
     * @method GET
     * @url admin/config/edit/{id}
     * @name admin.config.edit
     *
     * @param int $id
     * @return View|array
     */
    public function edit(int $id): View|array
    {
        try {
            $configuration = WebsiteConfiguration::findOrFail($id);
            
            $configTypes = [
                'text' => 'Text',
                'textarea' => 'Textarea',
                'image' => 'Image',
                'file' => 'File',
                'boolean' => 'Boolean (Yes/No)',
                'number' => 'Number',
                'json' => 'JSON',
                'email' => 'Email',
                'color' => 'Color',
                'url' => 'URL',
            ];

            return view('admin.pages.config.edit', [
                'configuration' => $configuration,
                'configGroups' => $this->configGroups,
                'configTypes' => $configTypes,
            ]);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Update the specified configuration in storage.
     *
     * @method PUT|PATCH
     * @url admin/config/update/{id}
     * @name admin.config.update
     *
     * @param ConfigUpdateRequest $request
     * @param int $id
     * @return RedirectResponse|array
     */
    public function update(ConfigUpdateRequest $request, int $id): RedirectResponse|array
    {
        try {
            $configuration = WebsiteConfiguration::findOrFail($id);
            $data = $request->validated();
            
            $data['updated_by'] = auth()->id();
            
            $configuration->update($data);
            
            clearConfigCache();
            
            return redirect()->route('admin.config', ['group' => $configuration->config_group])
                ->with('success', 'Configuration updated successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Upload an image for the specified configuration.
     *
     * @method POST
     * @url admin/config/upload-image
     * @name admin.config.upload-image
     *
     * @param ConfigImageRequest $request
     * @return JsonResponse|array
     */
    public function uploadImage(ConfigImageRequest $request): JsonResponse|array
    {
        try {
            $configKey = $request->input('config_key');
            $configuration = WebsiteConfiguration::where('config_key', $configKey)->firstOrFail();
            
            // Delete old image if exists
            $this->deleteImage($configuration);
            
            // Upload new image
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $configKey . '_' . time() . '.' . $extension;
            $path = $file->storeAs('configurations/' . $configuration->config_group, $fileName, 'public');
            
            // Update configuration
            $configuration->update([
                'config_value' => $path,
                'updated_by' => auth()->id(),
            ]);
            
            clearConfigCache();
            
            return response()->json([
                'status' => true,
                'message' => 'Image uploaded successfully.',
                'path' => asset('storage/' . $path),
                'oldImageDeleted' => true,
            ]);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Remove the specified configuration from storage.
     *
     * @method DELETE
     * @url admin/config/delete/{id}
     * @name admin.config.delete
     *
     * @param int $id
     * @return JsonResponse|array
     */
    public function destroy(int $id): JsonResponse|array
    {
        try {
            $configuration = WebsiteConfiguration::findOrFail($id);
            
            // Delete image if exists
            $this->deleteImage($configuration);
            
            $configuration->delete();
            
            clearConfigCache();
            
            return response()->json([
                'status' => true,
                'message' => 'Configuration deleted successfully.'
            ]);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Bulk update configurations for a group.
     *
     * @method POST
     * @url admin/config/bulk-update
     * @name admin.config.bulk-update
     *
     * @param Request $request
     * @return RedirectResponse|array
     */
    public function bulkUpdate(Request $request): RedirectResponse|array
    {
        try {
            $group = $request->input('group', 'general');
            $configs = $request->input('configs', []);
            
            foreach ($configs as $key => $value) {
                $config = WebsiteConfiguration::where('config_key', $key)->first();
                if ($config) {
                    $config->update([
                        'config_value' => $value,
                        'updated_by' => auth()->id(),
                    ]);
                }
            }
            
            clearConfigCache();
            
            return redirect()->route('admin.config', ['group' => $group])
                ->with('success', 'Configurations updated successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Reset configuration to default.
     *
     * @method POST
     * @url admin/config/reset/{id}
     * @name admin.config.reset
     *
     * @param int $id
     * @return JsonResponse|array
     */
    public function reset(int $id): JsonResponse|array
    {
        try {
            $configuration = WebsiteConfiguration::findOrFail($id);
            
            // Delete current image if exists
            if (in_array($configuration->config_type, ['image', 'file'])) {
                $this->deleteImage($configuration);
            }
            
            // Get default value from options if exists
            $defaultValue = null;
            if ($configuration->config_options && isset($configuration->config_options['default'])) {
                $defaultValue = $configuration->config_options['default'];
            }
            
            $configuration->update([
                'config_value' => $defaultValue,
                'updated_by' => auth()->id(),
            ]);
            
            clearConfigCache();
            
            return response()->json([
                'status' => true,
                'message' => 'Configuration reset to default.'
            ]);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Remove a single image from configuration.
     *
     * @method POST
     * @url admin/config/remove-image
     * @name admin.config.remove-image
     *
     * @param Request $request
     * @return JsonResponse|array
     */
    public function removeImage(Request $request): JsonResponse|array
    {
        try {
            $configKey = $request->input('config_key');
            $configuration = WebsiteConfiguration::where('config_key', $configKey)->firstOrFail();
            
            // Delete image
            $deleted = $this->deleteImage($configuration);
            
            // Update configuration
            $configuration->update([
                'config_value' => null,
                'updated_by' => auth()->id(),
            ]);
            
            clearConfigCache();
            
            return response()->json([
                'status' => true,
                'message' => $deleted ? 'Image removed successfully.' : 'No image to remove.',
                'deleted' => $deleted,
            ]);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Delete image from storage.
     *
     * @param WebsiteConfiguration $configuration
     * @return bool
     */
    private function deleteImage(WebsiteConfiguration $configuration): bool
    {
        if (empty($configuration->config_value)) {
            return false;
        }
        
        // Check if it's an image/file type
        if (!in_array($configuration->config_type, ['image', 'file'])) {
            return false;
        }
        
        // Check if file exists in storage
        if (Storage::disk('public')->exists($configuration->config_value)) {
            Storage::disk('public')->delete($configuration->config_value);
            return true;
        }
        
        return false;
    }

    /**
     * Get all images for a group.
     *
     * @method GET
     * @url admin/config/images/{group}
     * @name admin.config.images
     *
     * @param string $group
     * @return JsonResponse|array
     */
    public function getImages(string $group): JsonResponse|array
    {
        try {
            $images = WebsiteConfiguration::where('config_group', $group)
                ->whereIn('config_type', ['image', 'file'])
                ->whereNotNull('config_value')
                ->get(['config_key', 'config_label', 'config_value']);
            
            $data = $images->map(function ($item) {
                return [
                    'key' => $item->config_key,
                    'label' => $item->config_label,
                    'url' => $item->image_url,
                    'path' => $item->config_value,
                ];
            });
            
            return response()->json([
                'status' => true,
                'data' => $data,
            ]);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Clean up unused images from storage.
     *
     * @method POST
     * @url admin/config/cleanup-images
     * @name admin.config.cleanup-images
     *
     * @return JsonResponse|array
     */
    public function cleanupImages(): JsonResponse|array
    {
        try {
            $deletedCount = 0;
            $allConfigImages = WebsiteConfiguration::whereIn('config_type', ['image', 'file'])
                ->whereNotNull('config_value')
                ->pluck('config_value')
                ->toArray();
            
            // Get all files in configurations directory
            $files = Storage::disk('public')->files('configurations');
            
            foreach ($files as $file) {
                if (!in_array($file, $allConfigImages)) {
                    Storage::disk('public')->delete($file);
                    $deletedCount++;
                }
            }
            
            clearConfigCache();
            
            return response()->json([
                'status' => true,
                'message' => "{$deletedCount} unused images deleted.",
                'deletedCount' => $deletedCount,
            ]);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }
}