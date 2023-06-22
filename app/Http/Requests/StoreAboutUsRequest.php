<?php

namespace App\Http\Requests;

use App\Models\AboutUs;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAboutUsRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('about_us_create');
    }

    public function rules()
    {
        return [
            'phone_number' => [
                'string',
                'nullable',
            ],
            'phone_number_2' => [
                'string',
                'nullable',
            ],
            'normal_shipment_cost' => [
                'required',
            ],
            'fast_shipment_cost' => [
                'required',
            ],
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
