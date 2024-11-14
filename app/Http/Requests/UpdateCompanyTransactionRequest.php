<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyTransactionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'weight' => 'required|numeric|min:0',
            'price_per_kg' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'weight.required' => 'الوزن مطلوب.',
            'weight.numeric' => 'الوزن يجب أن يكون رقماً.',
            'price_per_kg.required' => 'سعر الكيلو مطلوب.',
            'price_per_kg.numeric' => 'سعر الكيلو يجب أن يكون رقماً.',
            'date.required' => 'التاريخ مطلوب.',
            'date.date' => 'التاريخ غير صالح.',
            'description.max' => 'الوصف يجب ألا يتجاوز 500 حرف.',
        ];
    }
}
