<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // هنا، نحن نفترض أن كل المستخدمين يمكنهم إضافة اليومية
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'daily_wage' => 'required|numeric|min:1', // الأجر اليومي يجب أن يكون أكبر من 0
            'overtime_hours' => 'nullable|numeric|min:0', // ساعات العمل الإضافية يمكن أن تكون صفر أو أكبر
            'date' => 'required|date', // التاريخ مطلوب
        ];
    }

    /**
     * Get the custom validation messages for the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'daily_wage.required' => 'الأجر اليومي مطلوب.',
            'daily_wage.numeric' => 'يجب أن يكون الأجر اليومي رقم.',
            'daily_wage.min' => 'يجب أن يكون الأجر اليومي أكبر من 0.',
            'overtime_hours.numeric' => 'ساعات العمل الإضافية يجب أن تكون رقم.',
            'overtime_hours.min' => 'ساعات العمل الإضافية يجب أن تكون أكبر من أو تساوي 0.',
            'date.required' => 'التاريخ مطلوب.',
            'date.date' => 'التاريخ يجب أن يكون بصيغة صحيحة.',
        ];
    }
}
