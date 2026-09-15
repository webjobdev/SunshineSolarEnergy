<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
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
        $productId = $this->route('id');

        return [
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($productId)],
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'brand_id' => 'nullable|exists:product_brands,id',
            'category_id' => 'nullable|exists:product_categories,id',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive',
            'new' => 'required|in:active,inactive',
            'trending' => 'required|in:active,inactive',
            'show_on_home_page' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
            'galleries' => 'nullable|array',
            'galleries.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'remove_galleries' => 'nullable|array',
            'remove_galleries.*' => 'exists:product_galleries,id',
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
            'name.required' => 'Product name is required',
            'slug.required' => 'Slug is required',
            'slug.unique' => 'This slug already exists',
            'status.required' => 'Status is required',
            'price.numeric' => 'Price must be a number',
            'price.min' => 'Price must be at least 0',
        ];
    }
}