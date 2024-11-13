<?php
// app/Services/ActivityLogService.php
namespace App\Services;

use App\Models\ActivityLog;

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
        ActivityLog::create([
            'item_id' => $payment->id,
            'merchant_id' => $merchantId,
            'type' => 'payment',
            'date' => $payment->date,
            'amount' => $payment->amount,
            'payment_type' => $payment->payment_type,
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
            'total_price' => $transaction->total_price,
        ]);
    }

    // Method to filter and fetch activity logs
    public function filterLogs($merchantId, $filters)
    {
        $query = ActivityLog::where('merchant_id', $merchantId);

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
}
