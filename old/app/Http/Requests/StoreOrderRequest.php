<?php

namespace App\Http\Requests;

use App\Models\Order;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_create');
    }

    public function rules()
    {
        return [
            'client_name' => [
                'string',
                'required',
            ],
            'phone_number' => [
                'string',
                'required',
            ],
            'phone_number_2' => [
                'string',
                'required',
            ],
            'shipping_address' => [
                'required',
            ],
            'delivery_status' => [
                'required',
            ],
            'shipment_type' => [
                'required',
            ],
            'area_code' => [
                'string',
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'product_id' => [
                'required',
                'integer',
            ],
        ];
    }
}