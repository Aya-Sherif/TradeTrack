<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyGoodRequest;
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
