<?php
// app/Services/MerchantService.php
namespace App\Services;

use App\Models\Merchant;

class MerchantService
{
    // Method to create a new merchant
    public function createMerchant($data)
    {
        return Merchant::create([
            'account_balance' => 0,
            'name' => $data['الاسم'],
        ]);
    }

    // Method to update a merchant's balance
    public function updateBalance(Merchant $merchant, $amount)
    {
        $merchant->account_balance -= $amount;
        $merchant->save();
    }

    // Method to retrieve all merchants or search by name
    public function getMerchants($query = null)
    {
        if ($query) {
            return Merchant::where('name', 'like', '%' . $query . '%')->get();
        }

        return Merchant::all();
    }
}
