<?php
// app/Http/Controllers/MerchantPaymentController.php
namespace App\Http\Controllers;

use App\Http\Requests\MerchantPaymentUpdateRequest;
use App\Http\Requests\StoreMerchantPaymentRequest;
use App\Models\Merchant;
use App\Models\MerchantPayment;
use App\Models\Season;
use App\Services\MerchantBalanceService;
use App\Services\MerchantPaymentService;

class MerchantPaymentController extends Controller
{
    protected $merchantPaymentService;
    protected $merchantBalanceService;

    // حقن الخدمات في الـ Controller
    public function __construct(MerchantPaymentService $merchantPaymentService, MerchantBalanceService $merchantBalanceService)
    {
        $this->merchantPaymentService = $merchantPaymentService;
        $this->merchantBalanceService = $merchantBalanceService;
    }

    // عرض النموذج لإنشاء دفع جديد
    public function create($merchant_id)
    {
        $merchant = Merchant::findOrFail($merchant_id);
        $seasons = Season::all();

        return view('merchant_payments.add', compact('merchant', 'seasons'));
    }

    // تخزين المدفوعات الجديدة
    public function store(StoreMerchantPaymentRequest $request, $merchant_id)
    {
        $merchant = Merchant::findOrFail($merchant_id);
// dd($request);
        // إضافة المدفوعات
        $payment = $this->merchantPaymentService->store($merchant_id, $request);

        // تحديث رصيد التاجر
        $this->merchantBalanceService->updateBalanceForNewPayment($merchant, $request->amount);

        return redirect()->route('merchants.index')
            ->with('success', 'تم خصم المبلغ بنجاح من الحساب');
    }

    // عرض النموذج لتعديل الدفع
    public function edit($merchant_id, $payment_id)
    {
        $payment = MerchantPayment::findOrFail($payment_id);
        $merchant = Merchant::findOrFail($merchant_id);

        return view('merchant_payments.edit', compact('payment', 'merchant'));
    }

    // تحديث المدفوعات
    public function update(MerchantPaymentUpdateRequest $request, $merchant_id, $payment_id)
    {
        $payment = MerchantPayment::findOrFail($payment_id);
        $merchant = Merchant::findOrFail($merchant_id);

        // حفظ المبلغ القديم
        $oldAmount = $payment->amount;

        // تحديث المدفوعات
        $this->merchantPaymentService->update($payment_id, $request->validated());

        // تحديث رصيد التاجر
        $newAmount = $request->amount;
        $this->merchantBalanceService->updateBalanceForUpdatedPayment($merchant, $oldAmount, $newAmount);

        return redirect()->route('merchants.show', $merchant_id)
            ->with('success', 'تم تحديث الدفع بنجاح');
    }

    public function destroy(string $id)
    {
        // طريقة الحذف
    }
}
