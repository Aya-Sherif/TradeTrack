<?php

// app/Services/MerchantBalanceService.php
namespace App\Services;

use App\Models\Merchant;

class MerchantBalanceService
{
    // تحديث رصيد التاجر عند إضافة سلعة جديدة
    public function updateBalanceForNewGood(Merchant $merchant, $totalPrice)
    {
        $merchant->account_balance += $totalPrice - 25; // يتم خصم 25 حسب المنطق الموجود
        $merchant->save();
    }

    // تحديث رصيد التاجر عند تعديل سلعة
    public function updateBalanceForUpdatedGood(Merchant $merchant, $oldTotalPrice, $newTotalPrice)
    {
        $merchant->account_balance = $merchant->account_balance - $oldTotalPrice + $newTotalPrice;
        $merchant->save();
    }
    // تحديث رصيد التاجر بعد إضافة مدفوعات
    public function updateBalanceForNewPayment(Merchant $merchant, $amount)
    {
        $merchant->account_balance -= $amount;
        $merchant->save();
    }

    // تحديث رصيد التاجر بعد تعديل المدفوعات
    public function updateBalanceForUpdatedPayment(Merchant $merchant, $oldAmount, $newAmount)
    {
        $merchant->account_balance = $merchant->account_balance + $oldAmount - $newAmount;
        $merchant->save();
    }
}
