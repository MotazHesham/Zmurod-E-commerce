<?php

namespace App\Http\Requests;

use App\Models\Post;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePostRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('post_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'min:5',
                'max:30',
                'required',
            ],
            'content' => [
                'required',
            ],
            'post_forum_id' => [
                'required',
                'integer',
            ],
            'author_id' => [
                'required',
                'integer',
            ],
            'post_comments.*' => [
                'integer',
            ],
            'post_comments' => [
                'array',
            ],
            'photos' => [
                'array',
            ],
            'post_tags.*' => [
                'integer',
            ],
            'post_tags' => [
                'array',
            ],
        ];
    }
}
