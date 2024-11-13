<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
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
