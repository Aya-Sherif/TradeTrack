@extends('layouts.lay')

@section('content')
<div class="main_content_container">
    <div class="main_container main_menu_open">
        <div class="page_content">
            <h1 class="heading_title">كشف حساب  : {{ $merchant->name }}</h1>
            <div class="client_balance" style="background-color: #f8f9fa; padding: 10px; margin-bottom: 10px; border-radius: 5px; border: 0.5px solid #dee2e6;">
                     <!-- Filter Form -->
                     <form method="GET" action="{{ route('merchants.show', $merchant->id) }}" class="mb-4">
                        <div class="row" style="align-items: flex-end;">

                            <!-- Submit Button -->
                            <div class="col-md-3" style="margin-top: 25px;">
                                <button type="submit" class="btn btn-primary">تصفية</button>
                            </div>
                            <!-- Payment Type Filter -->
                            <div class="col-md-3">
                                <label for="payment_type">نوع الدفع:</label>
                                <select name="payment_type" class="form-control">
                                    <option value="">اختر نوع الدفع</option>
                                    <option value="نقدي" {{ request('payment_type') == 'نقدي' ? 'selected' : '' }}>نقدي</option>
                                    <option value="تحويل بنك" {{ request('payment_type') == 'تحويل بنك' ? 'selected' : '' }}>تحويل بنك</option>
                                </select>
                            </div>

                            <!-- Transaction Type Filter -->
                            <div class="col-md-3">
                                <label for="type">نوع العملية:</label>
                                <select name="type" class="form-control">
                                    <option value="">اختر نوع العملية</option>
                                    <option value="payment" {{ request('type') == 'payment' ? 'selected' : '' }}>دفع</option>
                                    <option value="transaction" {{ request('type') == 'transaction' ? 'selected' : '' }}>بضاعة</option>
                                </select>
                            </div>

                            <!-- Date Filter -->
                            <div class="col-md-3">
                                <label for="date">التاريخ:</label>
                                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                            </div>

                        </div>
                    </form>

                <div class="row" style="display: flex; justify-content: flex-start; text-align: right;">
                    <h3 style="font-size: 2rem; font-weight: bold; color: #007bff; margin-left: 60px; margin-right: 30px;">صافى الحساب :
                        <span style="color: #28a745;">{{ number_format($merchant->account_balance, 2) }} جنيه</span>
                    </h3>
                    <h3 style="font-size: 2rem; font-weight: bold; color: #007bff; margin-left: 30px;">الموازين:
                        <span style="color: #28a745;">{{ $num*25 }} جنيه</span>
                    </h3>

                </div>

            </div>





            <div class="wrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: right;">#</th>
                            <th style="text-align: right;width: 150px;">التاريخ</th>
                            <th style="text-align: right;width: 100px;">الوزن</th>
                            <th style="text-align: right;width: 70px;">السعر </th>
                            <th style="text-align: right;width: 120px;">المبلغ</th>
                            <th style="text-align: right;width: 120px;">تنزيل</th>
                            <th style="text-align: right;width: 100px;">طريقة الدفع</th>
                            <th style="text-align: right;width: 120px;">المبلغ الكلي</th>
                            <th style="text-align: right;width: 150px;">ملاحظات</th>
                            <th style="text-align: right;width: 70px;">التحكم</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activityLogs as $item)
                        <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($item['date'])->format('Y-m-d') }}</td>

                                {{-- Check if it's a transaction --}}
                                @if ($item['type'] == 'transaction')
                                    <td>{{ intval($item['weight']) }} </td>
                                    <td>{{ intval($item['price_per_kg']) }} </td>
                                    <td>{{ intval($item['total_price']) }} </td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>{{ $item['total_in_this_step'] }}</td>
                                    <td>{{ $item['description'] }}</td>

                                {{-- Check if it's a payment --}}
                                @elseif ($item['type'] == 'payment')
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>{{ intval($item['amount']) }} </td>
                                    <td>{{ $item['payment_type'] }}</td>
                                    <td>{{ $item['total_in_this_step'] }}</td>
                                    <td>{{ $item['description'] }}</td>
                                @endif
                                <td>
                                    @if ($item['type'] == 'transaction')
                                        <!-- Edit button for transactions (goods) -->
                                        <a href="{{ route('goods.edit', ['merchant_id' => $merchant->id, 'good' => $item['item_id']]) }}"
                                           class="btn btn-default btn-warning" data-toggle="tooltip" data-placement="top"
                                           title="Edit Transaction"> تعديل  </a>
                                    @elseif ($item['type'] == 'payment')
                                        <!-- Edit button for payments -->
                                        <a href="{{ route('payments.edit', ['merchant_id' => $merchant->id, 'payment' => $item['item_id']]) }}"
                                           class="btn btn-default btn-warning" data-toggle="tooltip" data-placement="top"
                                           title="Edit Payment"> تعديل  </a>
                                    @endif
                                </td>


                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
