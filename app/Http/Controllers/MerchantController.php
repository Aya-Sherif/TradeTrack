<?php
// app/Http/Controllers/MerchantController.php
namespace App\Http\Controllers;

use App\Http\Requests\MerchantRequest;
use App\Services\MerchantService;
use App\Services\ActivityLogService;
use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    protected $merchantService;
    protected $activityLogService;

    // Inject the services into the controller's constructor
    public function __construct(MerchantService $merchantService, ActivityLogService $activityLogService)
    {
        $this->merchantService = $merchantService;
        $this->activityLogService = $activityLogService;
    }

    // Display a listing of the resource
    public function index(Request $request)
    {
        $query = $request->input('query');
        $merchants = $this->merchantService->getMerchants($query);

        return view('merchant.index', compact('merchants'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('merchant.add');
    }

    // Store a newly created resource in storage
    public function store(MerchantRequest $request)
    {
        $this->merchantService->createMerchant($request->validated());
        return redirect()->route('merchants.index')->with('success', 'تمت إضافة التاجر بنجاح.');
    }

    // Display the specified resource
    public function show(Request $request, $id)
    {
        $merchant = Merchant::findOrFail($id);

        // Truncate logs and log payments and transactions
        $this->activityLogService->truncateLogs();

        $merchantPayments = $merchant->merchantPayments()
            ->select('id', 'payment_date as date', 'amount', 'payment_type', 'description')
            ->get();

        $merchantTransactions = $merchant->merchantGoods()
            ->select('id', 'date', 'weight', 'price_per_kg', 'total_price')
            ->get();

        foreach ($merchantPayments as $payment) {
            $this->activityLogService->logPayment($payment, $merchant->id);
        }

        foreach ($merchantTransactions as $transaction) {
            $this->activityLogService->logTransaction($transaction, $merchant->id);
        }

        $filters = $request->only('payment_type', 'type', 'date');
        $activityLogs = $this->activityLogService->filterLogs($merchant->id, $filters);
$num=count($merchantTransactions);
        return view('merchant.show', compact('num','merchant', 'activityLogs'));
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $merchant = Merchant::findOrFail($id);
        return view('merchant.edit', compact('merchant'));
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $merchant = Merchant::findOrFail($id);
        $this->merchantService->updateBalance($merchant, $request->input('amount'));

        return redirect()->route('merchants.index')->with('success', 'Balance updated successfully');
    }

    // Handle the search functionality
    public function search(Request $request)
    {
        $query = $request->input('query');
        $merchants = $this->merchantService->getMerchants($query);

        return view('merchant.partials.table', compact('merchants'));
    }

    // Remove the specified resource from storage
    public function destroy(string $id)
    {
        // Logic to delete a merchant
    }
}
