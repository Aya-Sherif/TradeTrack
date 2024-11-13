<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMerchantGoodRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'weight' => 'required|numeric|min:0',
            'price_per_kg' => 'required|numeric|min:0',
            'date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'weight.required' => 'يرجى إدخال الوزن',
            'price_per_kg.required' => 'يرجى إدخال السعر لكل كيلو',
            'date.required' => 'يرجى إدخال التاريخ',
        ];
    }
}
