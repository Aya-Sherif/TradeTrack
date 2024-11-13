<?php
// app/Services/MerchantPaymentService.php
namespace App\Services;

use App\Models\MerchantPayment;

class MerchantPaymentService
{
    // إضافة مدفوعات جديدة
    public function store($merchantId, $data)
    {
        return MerchantPayment::create([
            'merchant_id' => $merchantId,
            'season_id' => $data['season_id'],
            'payment_type' => $data['payment_type'],
            'payment_date' => $data['payment_date'],
            'amount' => $data['amount'],
            'description' => $data['description'],
        ]);
    }

    // تحديث المدفوعات
    public function update($paymentId, $data)
    {
        $payment = MerchantPayment::findOrFail($paymentId);
        $payment->update([
            'amount' => $data['amount'],
            'payment_type' => $data['payment_type'],
            'payment_date' => $data['date'],
        ]);
        return $payment;
    }
}
