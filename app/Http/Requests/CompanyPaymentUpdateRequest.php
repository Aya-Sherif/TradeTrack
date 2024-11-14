<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyPaymentUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'amount' => 'required|numeric|min:0',
            'payment_type' => 'required|in:نقدي,تحويل بنك',
            'payment_date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'يرجى إدخال المبلغ.',
            'amount.numeric' => 'يجب أن يكون المبلغ عدداً.',
            'payment_type.required' => 'يرجى اختيار نوع الدفع.',
            'payment_type.in' => 'نوع الدفع غير صالح.',
            'payment_date.required' => 'يرجى اختيار تاريخ الدفع.',
            'payment_date.date' => 'تاريخ الدفع غير صالح.',
            'description.max' => 'يجب ألا يتجاوز الوصف 255 حرفاً.',
        ];
    }
}
