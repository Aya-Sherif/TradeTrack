<?php
// app/Http/Controllers/MerchantGoodsController.php
namespace App\Http\Controllers;

use App\Http\Requests\StoreMerchantGoodsRequest;
use App\Http\Requests\UpdateMerchantGoodRequest;
use App\Models\Merchant;
use App\Models\MerchantGood;
use App\Models\Season;
use App\Services\MerchantBalanceService;
use App\Services\MerchantGoodService;

class MerchantGoodsController extends Controller
{
    protected $merchantGoodService;
    protected $merchantBalanceService;

    // حقن الخدمات في الـ Controller
    public function __construct(MerchantGoodService $merchantGoodService, MerchantBalanceService $merchantBalanceService)
    {
        $this->merchantGoodService = $merchantGoodService;
        $this->merchantBalanceService = $merchantBalanceService;
    }

    // عرض النموذج لإنشاء سلعة جديدة
    public function create($merchantId)
    {
        $merchant = Merchant::findOrFail($merchantId);
        $seasons = Season::all();
        return view('merchant-goods.add', compact('merchant', 'seasons'));
    }

    // تخزين السلع الجديدة
    public function store(StoreMerchantGoodsRequest $request, $merchantId)
    {
        $good = $this->merchantGoodService->store($merchantId, $request->validated());

        $merchant = Merchant::findOrFail($merchantId);

        // تحديث رصيد التاجر بعد إضافة السلعة
        $this->merchantBalanceService->updateBalanceForNewGood($merchant, $request->total_price);

        return redirect()->route('merchants.index', $merchantId)->with('success', 'تم إضافة البضاعة بنجاح');
    }

    // عرض النموذج لتعديل سلعة
    public function edit($merchant_id, $good_id)
    {
        $merchant = Merchant::findOrFail($merchant_id);
        $good = MerchantGood::where('merchant_id', $merchant_id)->findOrFail($good_id);
        $seasons = Season::all();

        return view('merchant-goods.edit', compact('good', 'seasons', 'merchant'));
    }

    // تحديث السلعة
    public function update(UpdateMerchantGoodRequest $request, $merchant_id,$id)
    {

        $good = MerchantGood::findOrFail($id);
        $merchant = Merchant::findOrFail($merchant_id);
        // حفظ الرصيد القديم
        $oldTotalPrice = $good->total_price;

        // تحديث السلعة
        $this->merchantGoodService->update($id, $request->validated());

        // تحديث رصيد التاجر
        $newTotalPrice = $request->weight * $request->price_per_kg;
        $this->merchantBalanceService->updateBalanceForUpdatedGood($merchant, $oldTotalPrice, $newTotalPrice);

        return redirect()->route('merchants.show', $merchant_id)
            ->with('success', 'تم تحديث البضاعة بنجاح');
    }

    public function destroy(string $id)
    {
        // طريقة الحذف
    }
}
