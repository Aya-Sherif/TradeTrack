<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\ActivityLog;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        // If there is a search query, filter companies by name
        if ($query) {
            $companies = Company::where('name', 'like', '%' . $query . '%')->get();
        } else {
            $companies = Company::all();
        }

        // Return the index view with the companies
        return view('company.index', compact('companies'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.add');
    }

    // Store a newly created company in the database
    public function store(StoreCompanyRequest $request)
    {
        // Validate and store the company
        Company::create([
            'name' => $request->input('name'),
            'account_balance' => $request->input('account_balance', 0),  // Default balance to 0 if not provided
        ]);

        // Redirect to the companies index with success message
        return redirect()->route('companies.index')->with('success', 'تم إضافة الشركة بنجاح');
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        // Find the specific company or fail if it doesn't exist
        $company = Company::findOrFail($id);

        // dd(1);
        // Clear logs for fresh activity tracking
        ActivityLog::truncate();

        // Retrieve company payments
        $companyPayments = $company->Payments()
            ->select('id', 'payment_date as date', 'payment_amount as amount', 'payment_method',  'updated')
            ->get();

        // Retrieve company transactions
        $companyTransactions = $company->transactions()
            ->select('id', 'transaction_date as date', 'weight', 'price_per_kg', 'total_cost', 'updated')
            ->get();

        // Log each payment as an activity log
        foreach ($companyPayments as $payment) {
            ActivityLog::create([
                'temp_id' => $company->id,
                'item_id' => $payment->id,
                'type' => 'payment',
                'date' => $payment->date,
                'amount' => $payment->amount,
                'payment_type' => $payment->payment_method,
                'updated' => $payment->updated,
            ]);
        }

        // Log each transaction as an activity log
        foreach ($companyTransactions as $transaction) {
            ActivityLog::create([
                'temp_id' => $company->id,
                'item_id' => $transaction->id,
                'type' => 'transaction',
                'date' => $transaction->date,
                'weight' => $transaction->weight,
                'price_per_kg' => $transaction->price_per_kg,
                'total_price' => $transaction->total_cost,
                'description' => $transaction->description,
                'updated' => $transaction->updated,
            ]);
        }
        $activatedlogs = ActivityLog::orderBy('date')->get();
        $oldValue = 0;
        foreach ($activatedlogs as $item) {

            if ($item->type == 'payment') {

                $item->update([
                    'total_in_this_step' => $oldValue - $item->amount
                ]);
            } else {
                $item->update([
                    'total_in_this_step' => $oldValue + $item->total_price
                ]);
            }

            $oldValue = $item->total_in_this_step;
        }
        // Apply filters to the logs if provided in the request
        $filters = $request->only('payment_type', 'type', 'date');
        $activityLogs = ActivityLog::where('temp_id', $company->id);

        if (!empty($filters['payment_type'])) {
            $activityLogs->where('payment_type', $filters['payment_type']);
        }

        if (!empty($filters['type'])) {
            $activityLogs->where('type', $filters['type']);
        }

        if (!empty($filters['date'])) {
            $activityLogs->whereDate('date', $filters['date']);
        }

        // Get the filtered and ordered activity logs
        $activityLogs = $activityLogs->orderBy('date')->get();

        // Count the transactions for a weight-based total
        $num = count($companyTransactions);

        // Return view with all required data
        return view('company.show', compact('num', 'company', 'activityLogs'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
