<?php

namespace App\Http\Requests;

use App\Models\EntityType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEntityTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('entity_type_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'min:3',
            ],
            'is_individual' => [
                'required',
                'boolean',
            ],
            'organization_name' => [
                'nullable',
                'string',
                'min:3',
                'required_if:is_individual,0',
            ],
        ];
    }
}
