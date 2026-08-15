<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'page_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'focus_keyword' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|string|max:255',
            'robots' => [
                'required',
                Rule::in([
                    'index,follow',
                    'index,nofollow',
                    'noindex,follow',
                    'noindex,nofollow',
                ]),
            ],
            'status' => 'required|in:active,inactive',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'page_name.required' => 'Page name is required',
            'slug.required' => 'Slug is required',
            'slug.unique' => 'This slug already exists',
            'robots.required' => 'Robots setting is required',
            'status.required' => 'Status is required',
        ];
    }
}
