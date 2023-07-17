<?php

namespace App\Http\Requests;

use App\Models\Seller;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSellerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('seller_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users,email,' . request()->user_id,
            ],
            'photo' => [
                'required',
            ],
            'store_name' => [
                'string',
                'required',
            ],
            'description' => [
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
