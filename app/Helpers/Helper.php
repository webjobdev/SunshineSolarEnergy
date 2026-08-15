<?php

use App\Models\Admin\WebsiteConfiguration;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


/**
 * Return a successful response.
 *
 * @param mixed $data Data to return.
 * @param string $message Success message.
 * @return array
 */
function successResponse($data, $message = '')
{
    if ($message == '') {
        $message = 'Data successfully fetched';
    }
    $type = 'success';
    $response = [
        'data' => $data,
        'message' => $message,
        'type' =>  $type,
        'variant' => $type,
    ];
    return $response;
}

/**
 * Return an error response.
 *
 * @param string $message Error message.
 * @return array
 */
function errorResponse($message = '')
{
    if ($message == '') {
        $message = 'Something went wrong !';
    }
    Log::error($message);
    $response = [
        'message' => $message,
        'type' => 'error',
        'variant' => 'danger',
    ];
    return $response;
}

/**
 * Handle an exception and return a JSON error response.
 *
 * Logs the exception and returns the actual message in debug mode,
 * otherwise returns a generic error message.
 *
 * @param Throwable $e Exception instance.
 * @return \Illuminate\Http\JsonResponse
 */
function errorMsg($e)
{
    Log::error($e);
    return response()->json([
        'status'  => false,
        'message' => $e->getMessage(),
        ], 500);
}


// ------------------------------------------------------------- config

/**
 * Get a single configuration value by key.
 *
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
if (!function_exists('configSetting')) {
    function configSetting(string $key, mixed $default = null): mixed
    {
        $settings = Cache::remember('website_configurations', 3600, function () {
            return WebsiteConfiguration::all()->pluck('config_value', 'config_key')->toArray();
        });

        return $settings[$key] ?? $default;
    }
}

/**
 * Get all configurations as array.
 *
 * @return array
 */
if (!function_exists('configSettings')) {
    function configSettings(): array
    {
        return Cache::remember('website_configurations_all', 3600, function () {
            return WebsiteConfiguration::all()->pluck('config_value', 'config_key')->toArray();
        });
    }
}

/**
 * Get configuration image URL.
 *
 * @param string $key
 * @param string|null $default
 * @return string|null
 */
if (!function_exists('configImage')) {
    function configImage(string $key, ?string $default = null): ?string
    {
        $value = configSetting($key);
        if (empty($value)) {
            return $default;
        }
        return asset('storage/' . $value);
    }
}

/**
 * Check if configuration exists.
 *
 * @param string $key
 * @return bool
 */
if (!function_exists('hasConfig')) {
    function hasConfig(string $key): bool
    {
        return configSetting($key) !== null;
    }
}

/**
 * Clear configurations cache.
 *
 * @return void
 */
if (!function_exists('clearConfigCache')) {
    function clearConfigCache(): void
    {
        Cache::forget('website_configurations');
        Cache::forget('website_configurations_all');
    }
}

/**
 * Get configurations by group.
 *
 * @param string $group
 * @return array
 */
if (!function_exists('configGroup')) {
    function configGroup(string $group): array
    {
        return Cache::remember('website_configurations_group_' . $group, 3600, function () use ($group) {
            return WebsiteConfiguration::where('config_group', $group)
                ->pluck('config_value', 'config_key')
                ->toArray();
        });
    }
}

/**
 * Delete configuration image by key.
 *
 * @param string $key
 * @return bool
 */
if (!function_exists('deleteConfigImage')) {
    function deleteConfigImage(string $key): bool
    {
        $config = WebsiteConfiguration::where('config_key', $key)->first();
        if (!$config || !in_array($config->config_type, ['image', 'file']) || empty($config->config_value)) {
            return false;
        }
        
        if (Storage::disk('public')->exists($config->config_value)) {
            Storage::disk('public')->delete($config->config_value);
            return true;
        }
        return false;
    }
}

/**
 * Get all configuration images.
 *
 * @param string|null $group
 * @return \Illuminate\Support\Collection
 */
if (!function_exists('getConfigImages')) {
    function getConfigImages(?string $group = null)
    {
        $query = WebsiteConfiguration::whereIn('config_type', ['image', 'file'])
            ->whereNotNull('config_value');
        
        if ($group) {
            $query->where('config_group', $group);
        }
        
        return $query->get()->map(function ($item) {
            return (object) [
                'key' => $item->config_key,
                'label' => $item->config_label,
                'url' => $item->image_url,
                'path' => $item->config_value,
            ];
        });
    }
}

/**
 * Clean up unused images.
 *
 * @return int
 */
if (!function_exists('cleanupConfigImages')) {
    function cleanupConfigImages(): int
    {
        $usedImages = WebsiteConfiguration::whereIn('config_type', ['image', 'file'])
            ->whereNotNull('config_value')
            ->pluck('config_value')
            ->toArray();
        
        $allFiles = Storage::disk('public')->files('configurations');
        $deletedCount = 0;
        
        foreach ($allFiles as $file) {
            if (!in_array($file, $usedImages)) {
                Storage::disk('public')->delete($file);
                $deletedCount++;
            }
        }
        
        return $deletedCount;
    }
}
// ------------------------------------------------------------- end config