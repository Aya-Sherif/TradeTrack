<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyPaymentUpdateRequest;
use App\Http\Requests\StoreCompanyPaymentRequest;
use App\Models\Company;
use App\Models\CompanyPayment;
use App\Models\Season;
use Illuminate\Http\Request;

class CompanyPaymentController extends Controller
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
    public function create($company_Id)
    {
        //
        $company = Company::findOrFail($company_Id);
        $seasons = Season::all();

        return view('company.payments.add', compact('company', 'seasons'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyPaymentRequest $request, $companyId)
    {
        // Validate and find the relevant company
        $company = Company::findOrFail($companyId);
// dd($company);
        // Create a new company payment entry
        $payment = new CompanyPayment();
        $payment->company_id = $company->id;
        $payment->season_id = $request->input('season_id');
        $payment->payment_method = $request->input('payment_type');
        $payment->payment_amount = $request->input('amount');
        $payment->payment_date = $request->input('payment_date');
        $payment->save();

        // Update the company balance
        $company->account_balance = $company->account_balance-$payment->payment_amount;
        // dd($company->account_balance );

        $company->save();

        // Redirect to the company's detail or index page with a success message
        return redirect()->route('companies.index')
            ->with('success', 'تم تحديث حساب الشركة بنجاح');
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
    public function edit($company_id, $payment_id)
    {
        $payment = CompanyPayment::findOrFail($payment_id);
        $company = Company::findOrFail($company_id);

        return view('company.payments.edit', compact('payment', 'company'));
    }

    // تحديث المدفوعات
    public function update(CompanyPaymentUpdateRequest $request, $companyId, $paymentId)
    {
        // Find the company and payment
        $company = Company::findOrFail($companyId);
        $payment = CompanyPayment::where('company_id', $companyId)->findOrFail($paymentId);

        // Calculate balance adjustment
        $originalAmount = $payment->payment_amount;
        $newAmount = $request->input('amount');
        $balanceAdjustment = $newAmount - $originalAmount;

        // Update payment details
        $payment->update([
            'payment_amount' => $newAmount,
            'payment_method' => $request->input('payment_type'),
            'payment_date' => $request->input('payment_date'),
        ]);
        if($balanceAdjustment!=0)
        {
            $payment->update([
            'updated'=>0
            ]);
        }

        // Update company balance
        $company->account_balance -= $balanceAdjustment;
        $company->save();

        // Redirect with success message
        return redirect()->route('companies.show', $companyId)->with('success', 'تم تحديث الدفعة بنجاح');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
