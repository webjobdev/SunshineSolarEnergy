<?php

namespace App\Http\Requests\Admin\Blog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogStoreRequest extends FormRequest
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
            'category_id' => 'nullable|exists:blog_categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'focus_keyword' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|string|max:255|url',
            'robots' => [
                'nullable',
                Rule::in([
                    'index,follow',
                    'index,nofollow',
                    'noindex,follow',
                    'noindex,nofollow',
                ]),
            ],
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',
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
            'title.required' => 'Blog title is required',
            'slug.required' => 'Slug is required',
            'slug.unique' => 'This slug already exists',
            'content.required' => 'Blog content is required',
            'status.required' => 'Status is required',
            'featured_image.image' => 'Featured image must be an image file',
            'featured_image.mimes' => 'Featured image must be jpeg, png, jpg, gif, or webp',
            'featured_image.max' => 'Featured image must not exceed 2MB',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        // Set default robots if not provided
        if ($this->input('robots') === null || $this->input('robots') === '') {
            $this->merge([
                'robots' => 'index,follow',
            ]);
        }
    }
}