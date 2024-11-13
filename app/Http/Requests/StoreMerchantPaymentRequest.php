<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMerchantPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Change this if you want to implement authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'season_id' => 'required|exists:seasons,id', // Ensure season exists in the 'seasons' table
            'payment_type' => 'required|string|in:نقدي,تحويل بنك', // Ensure payment type is one of the options
            'payment_date' => 'required|date', // Ensure date is in a valid date format
            'amount' => 'required|numeric|min:0', // Ensure amount is a positive number
            ];
    }

    /**
     * Get custom error messages for validation failures.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'season_id.required' => 'الموسم هو حقل مطلوب.',
            'season_id.exists' => 'الموسم المحدد غير موجود.',
            'payment_type.required' => 'طريقة الدفع هي حقل مطلوب.',
            'payment_type.in' => 'طريقة الدفع يجب أن تكون نقدي أو تحويل بنك.',
            'payment_date.required' => 'التاريخ هو حقل مطلوب.',
            'payment_date.date' => 'التاريخ يجب أن يكون بتنسيق صحيح.',
            'amount.required' => 'المبلغ هو حقل مطلوب.',
            'amount.numeric' => 'المبلغ يجب أن يكون رقمًا.',
            'amount.min' => 'المبلغ يجب أن يكون أكبر من أو يساوي 0.',
        ];
    }
}
