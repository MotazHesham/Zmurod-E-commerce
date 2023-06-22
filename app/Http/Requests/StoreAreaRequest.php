<?php

namespace App\Http\Requests;

use App\Models\Area;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAreaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('area_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'city' => [
                'required',
            ],
            'shipping_cost' => [
                'required',
            ],
            'active_area' => [
                'required',
            ],
        ];
    }
}
