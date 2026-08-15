<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\WebsiteConfiguration;
use Exception;
use Illuminate\Http\JsonResponse;

class ConfigController extends Controller
{
    /**
     * Get all website configurations.
     *
     * @method GET
     * @url api/configurations
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $configs = WebsiteConfiguration::whereNotNull('config_value')
                ->get()
                ->pluck('config_value', 'config_key');
            
            return response()->json([
                'status' => true,
                'data' => $configs
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get single configuration by key.
     *
     * @method GET
     * @url api/configurations/{key}
     *
     * @param string $key
     * @return JsonResponse
     */
    public function show(string $key): JsonResponse
    {
        try {
            $config = WebsiteConfiguration::where('config_key', $key)->first();
            
            return response()->json([
                'status' => true,
                'data' => $config ? $config->config_value : null
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}