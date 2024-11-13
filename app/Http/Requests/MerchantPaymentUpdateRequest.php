<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MerchantPaymentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:0',
            'payment_type' => 'required|string',

            'date' => 'required|date',
        ];
    }
    public function messages()
    {
        return [
            'amount.required' => 'يرجى إدخال المبلغ.',
            'amount.numeric' => 'المبلغ يجب أن يكون رقمًا.',
            'amount.min'=>'المبلغ يجب أن يكون أكبر من 0 ',
            'payment_type.required' => 'يرجى اختيار نوع الدفع.',
            'date.required' => 'يرجى إدخال التاريخ.',
            'date.date' => 'يرجى إدخال تاريخ صالح.',
        ];
    }
}
