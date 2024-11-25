@extends('layouts.lay')

@section('content')
    <div class="main_content_container">
        <div class="main_container main_menu_open">
            <div class="page_content">
                <!-- تفاصيل السائق -->
                <div class="row">

                    <div class="worker-details mb-4">
                        <h1 class="heading_title text-right">كشف حساب: {{ $driver->name }}</h1>
                        <div class="row mt-4">
                            <!-- رصيد العامل -->
                            <div class="col-md-6">
                                <div class="card shadow-sm p-3 mb-3 rounded">
                                    <h3 class="text-center">الرصيد</h3>
                                    <p class="text-center text-primary" style="font-size: 20px;">
                                        {{ number_format($driver->account_balance, 0) }} جنيه
                                    </p>
                                </div>
                            </div>

                            <!-- اسم العامل -->
                            <div class="col-md-6">
                                <div class="card shadow-sm p-3 mb-3 rounded">
                                    <h3 class="text-center">الاسم</h3>
                                    <p class="text-center text-success" style="font-size: 20px;">
                                        {{ $driver->name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <!-- جدول المدفوعات -->
                    <div class="col-md-5">
                        <h4 class="text-right">المدفوعات</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-right">التاريخ</th>
                                    <th class="text-right">المبلغ</th>
                                    <th class="text-right">الإجراء</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($payment->paid_at)->locale('ar')->isoFormat('dddd، D MMMM YYYY') }}</td>
                                        <td>{{ number_format($payment->amount, 2) }} جنيه</td>
                                        <td>
                                            <a href="{{ route('pay.edit', $payment->id) }}" class="btn btn-primary btn-sm">تعديل</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- جدول الرحلات -->
                    <div class="col-md-7">
                        <h4 class="text-right">سجل الرحلات</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-right">التاريخ</th>
                                    <th class="text-right">من</th>
                                    <th class="text-right">إلى</th>
                                    <th class="text-right">الأجرة</th>
                                    <th class="text-right">الإجراء</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trips as $trip)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($trip->trip_date)->locale('ar')->isoFormat('dddd، D MMMM YYYY') }}</td>
                                        <td>{{ $trip->start_from }}</td>
                                        <td>{{ $trip->to }}</td>
                                        <td>{{ number_format($trip->fare, 2) }} </td>
                                        <td>
                                            <a href="{{ route('drivers.edit', [$driver->id, $trip->id]) }}" class="btn btn-primary btn-sm">تعديل</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- إضافة أزرار جديدة -->
                <div class="mt-4">
                    <a href="{{ route('pay.create', $driver->id) }}" class="btn btn-success">إضافة مدفوعات</a>
                    <a href="{{ route('drivers.create', $driver->id) }}" class="btn btn-info">إضافة رحلة</a>
                </div>
            </div>
        </div>
    </div>
@endsection
