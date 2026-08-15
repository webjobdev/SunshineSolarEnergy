<?php

namespace App\Http\Requests\Admin\Blog;

use Illuminate\Foundation\Http\FormRequest;

class BlogCommentStoreRequest extends FormRequest
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
            'blog_id' => 'required|exists:blogs,id',
            'parent_id' => 'nullable|exists:blog_comments,id',
            'comment' => 'required|string|min:3|max:1000',
            'author_name' => 'nullable|string|max:255',
            'author_email' => 'nullable|email|max:255',
            'author_website' => 'nullable|url|max:255',
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
            'blog_id.required' => 'Blog ID is required',
            'comment.required' => 'Comment is required',
            'comment.min' => 'Comment must be at least 3 characters',
            'author_email.email' => 'Please enter a valid email address',
        ];
    }
}