<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMerchantGoodsRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow everyone to use this request
    }

    public function rules()
    {
        return [
            'season_id' => 'required|exists:seasons,id',
            'weight' => 'required|numeric',
            'price_per_kg' => 'required|numeric',
            'total_price' => 'required|numeric',
            'date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'season_id.required' => 'يرجى اختيار الموسم.',
            'season_id.exists' => 'الموسم الذي اخترته غير موجود.',
            'weight.required' => 'يرجى إدخال الوزن.',
            'weight.numeric' => 'الوزن يجب أن يكون رقماً.',
            'price_per_kg.required' => 'يرجى إدخال السعر لكل كيلو.',
            'price_per_kg.numeric' => 'السعر لكل كيلو يجب أن يكون رقماً.',
            'total_price.required' => 'يرجى إدخال السعر الكلي.',
            'total_price.numeric' => 'السعر الكلي يجب أن يكون رقماً.',
            'date.required' => 'يرجى اختيار التاريخ.',
            'date.date' => 'يرجى إدخال تاريخ صحيح.',
        ];
    }
}
