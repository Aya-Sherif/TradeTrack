<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyGoodRequest;
use App\Http\Requests\UpdateCompanyTransactionRequest;
use App\Models\Company;
use App\Models\CompanyTransaction;
use App\Models\Season;
use Illuminate\Http\Request;

class CompanyGoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    // Show the form for creating a new good for a specific company
    public function create($companyId)
    {
        // dd(1);
        // Find the company by its ID
        $company = Company::findOrFail($companyId);

        // Get all available seasons
        $seasons = Season::all();

        // Return the view with company and seasons
        return view('company.goods.create', compact('company', 'seasons'));
    }

    /**
     * Store a newly created transaction.
     */
    public function store(StoreCompanyGoodRequest $request, $companyId)
    {
        // Find the company by its ID
        $company = Company::findOrFail($companyId);

        // Store the transaction in the database
        $companyGood = new CompanyTransaction();
        $companyGood->company_id = $company->id;
        $companyGood->season_id = $request->season_id;
        $companyGood->weight = $request->weight;
        $companyGood->price_per_kg = $request->price_per_kg;
        $companyGood->total_cost = $request->total_cost;
        $companyGood->transaction_date = $request->date;
        $companyGood->save();

        // Optionally, update the company's balance or other fields here if needed
        // Example:
        $company->account_balance += $companyGood->total_cost;
        $company->save();

        // Redirect to the company transactions page with a success message
        return redirect()->route('companies.index', $company->id)
            ->with('success', 'تم إضافة البضاعة بنجاح');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($companyId, $transactionId)
    {
        // Retrieve the company and the specific transaction
        $company = Company::findOrFail($companyId);
        $transaction = CompanyTransaction::where('company_id', $company->id)->findOrFail($transactionId);

        // Pass company and transaction data to the view
        return view('company.goods.edit', compact('company', 'transaction'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyTransactionRequest $request, $companyId, $transactionId)
    {
        // Find the company and transaction
        $company = Company::findOrFail($companyId);
        $transaction = CompanyTransaction::where('company_id', $company->id)->findOrFail($transactionId);
        $oldamount = $company->account_balance - $transaction->total_cost;

        // Update transaction fields
        $transaction->weight = $request->input('weight');
        $transaction->price_per_kg = $request->input('price_per_kg');
        $transaction->total_cost = $request->input('weight') * $request->input('price_per_kg');
        $transaction->transaction_date = $request->input('date');
        $transaction->save();

        $company->account_balance = $oldamount + $transaction->total_cost;
        $company->save();

        if ($oldamount != $company->account_balance) {
            $transaction->updated = 0;
            $transaction->save();
        }
        // Redirect to the company's transaction page with a success message
        return redirect()->route('companies.show', parameters: $company->id)
            ->with('success', 'تم تعديل المعاملة بنجاح');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
