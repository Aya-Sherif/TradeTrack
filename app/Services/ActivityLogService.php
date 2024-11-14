<?php
// app/Services/ActivityLogService.php
namespace App\Services;

use App\Models\ActivityLog;

use function PHPSTORM_META\type;

class ActivityLogService
{
    // Method to truncate the activity logs table
    public function truncateLogs()
    {
        ActivityLog::truncate();
    }

    // Method to log payment activity
    public function logPayment($payment, $merchantId)
    {
        // dd($payment);

        ActivityLog::create([
            'item_id' => $payment->id,
            'merchant_id' => $merchantId,
            'type' => 'payment',
            'date' => $payment->date,
            'amount' => $payment->amount,
            'payment_type' => $payment->payment_type,
            'updated'=>$payment->updated,
            'description' => $payment->description,
        ]);
    }

    // Method to log transaction activity
    public function logTransaction($transaction, $merchantId)
    {
        ActivityLog::create([
            'item_id' => $transaction->id,
            'merchant_id' => $merchantId,
            'type' => 'transaction',
            'date' => $transaction->date,
            'weight' => $transaction->weight,
            'price_per_kg' => $transaction->price_per_kg,
            'updated'=>$transaction->updated,
            'total_price' => $transaction->total_price,
        ]);
    }

    // Method to filter and fetch activity logs
    public function filterLogs($merchantId, $filters)
    {
        $this->SetTotal();
        $query = ActivityLog::where('merchant_id', $merchantId);
// dd($query->orderBy('date')->get());
        if (isset($filters['payment_type'])) {
            $query->where('payment_type', $filters['payment_type']);
        }
        if (isset($filters['type'])) {
            $query->where('type', $filters['type']);
        }
        if (isset($filters['date'])) {
            $query->whereDate('date', $filters['date']);
        }

        return $query->orderBy('date')->get();
    }
    public function SetTotal()
    {
        $activatedlogs = ActivityLog::orderBy('date')->get();
$oldValue=0;
        foreach ($activatedlogs as $item) {

            if($item->type=='payment')
            {

                $item->update([
                    'total_in_this_step' => $oldValue + $item->amount
                ]);
            }
            else{
                $item->update([
                    'total_in_this_step' => $oldValue + $item->total_price
                ]);
            }

            $oldValue=$item->total_in_this_step;
            // dd( $item);
        }
    }

}
