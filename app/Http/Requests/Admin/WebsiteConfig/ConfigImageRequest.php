<?php

namespace App\Http\Requests\Admin\WebsiteConfig;

use Illuminate\Foundation\Http\FormRequest;

class ConfigImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,ico|max:2048',
            'config_key' => 'required|string|exists:website_configurations,config_key',
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'image.required' => 'Please select an image to upload',
            'image.image' => 'File must be an image',
            'image.mimes' => 'Image must be jpeg, png, jpg, gif, svg, webp, or ico',
            'image.max' => 'Image must not exceed 2MB',
        ];
    }
}