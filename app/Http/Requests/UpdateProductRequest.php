<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'current_stock' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'information' => [
                'required',
            ],
            'image' => [
                'array',
                'required',
            ],
            'image.*' => [
                'required',
            ],
            'product_tags.*' => [
                'integer',
            ],
            'product_tags' => [
                'array',
            ],
            'product_category_id' => [
                'required',
                'integer',
            ],
            'product_offers.*' => [
                'integer',
            ],
            'product_offers' => [
                'array',
            ],
        ];
    }
}
