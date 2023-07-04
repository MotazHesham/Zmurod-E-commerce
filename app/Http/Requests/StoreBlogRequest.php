<?php

namespace App\Http\Requests;

use App\Models\Blog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBlogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('blog_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'min:3',
                'max:30',
                'required',
            ],
            'content' => [
                'required',
            ],
            'short_description' => [
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'media_url' => [
                'string',
                'nullable',
            ],
            'type' => [
                'required',
            ],
            'blog_comments.*' => [
                'integer',
            ],
            'blog_comments' => [
                'array',
            ],
        ];
    }
}
