<?php

namespace App\Http\Requests;

use App\Models\Froum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFroumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('froum_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'min:3',
                'nullable',
            ],
            'description' => [
                'required',
            ],
            'category' => [
                'required',
            ],
        ];
    }
}
