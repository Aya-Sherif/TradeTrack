<?php
// app/Services/MerchantGoodService.php
namespace App\Services;

use App\Models\Merchant;
use App\Models\MerchantGood;

class MerchantGoodService
{
    // إضافة سلعة جديدة
    public function store($merchantId, $data)
    {
        $merchant=Merchant::findOrFail($merchantId);
        return MerchantGood::create([
            'merchant_id' => $merchantId,
            'season_id' => $data['season_id'],
            'weight' => $data['weight'],
            'price_per_kg' => $data['price_per_kg'],
            'total_price' => $data['total_price'],
            'date' => $data['date'],
        ]);
    }

    // تحديث سلعة
    public function update($goodId, $data)
    {
        $good = MerchantGood::findOrFail($goodId);
        $good->update([
            'weight' => $data['weight'],
            'price_per_kg' => $data['price_per_kg'],
            'total_price' => $data['weight'] * $data['price_per_kg'],
            'updated'=>1,
            'date' => $data['date'],
        ]);

        return $good;
    }
}
