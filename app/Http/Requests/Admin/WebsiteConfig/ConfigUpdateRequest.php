<?php

namespace App\Http\Requests\Admin\WebsiteConfig;

use Illuminate\Foundation\Http\FormRequest;

class ConfigUpdateRequest extends FormRequest
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
            'config_key' => 'required|string|max:100|exists:website_configurations,config_key',
            'config_value' => 'nullable|string|max:65535',
            'config_type' => 'required|in:text,textarea,image,file,boolean,number,json,email,color,url',
            'config_group' => 'required|string|max:50',
            'config_label' => 'required|string|max:255',
            'config_placeholder' => 'nullable|string|max:255',
            'config_help' => 'nullable|string|max:500',
            'config_options' => 'nullable|json',
            'is_required' => 'nullable|boolean',
            'is_editable' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
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
            'config_key.required' => 'Configuration key is required',
            'config_key.unique' => 'This configuration key already exists',
            'config_label.required' => 'Label is required',
            'config_type.in' => 'Invalid configuration type',
        ];
    }
}