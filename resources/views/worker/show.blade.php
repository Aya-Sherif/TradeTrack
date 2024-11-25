@extends('layouts.lay')

@section('content')
    <div class="main_content_container">
        <div class="main_container main_menu_open">
            <div class="page_content">
                <!-- Start Row for Worker Details -->
                <div class="row">

                    <div class="worker-details mb-4">
                        <h1 class="heading_title text-right">تفاصيل العامل: {{ $worker->name }}</h1>
                        <div class="row mt-4">
                            <!-- رصيد العامل -->
                            <div class="col-md-6">
                                <div class="card shadow-sm p-3 mb-3 rounded">
                                    <h3 class="text-center">الرصيد</h3>
                                    <p class="text-center text-primary" style="font-size: 20px;">
                                        {{ number_format($worker->account_balance, 2) }} جنيه
                                    </p>
                                </div>
                            </div>

                            <!-- اسم العامل -->
                            <div class="col-md-6">
                                <div class="card shadow-sm p-3 mb-3 rounded">
                                    <h3 class="text-center">الاسم</h3>
                                    <p class="text-center text-success" style="font-size: 20px;">
                                        {{ $worker->name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <a href="{{ route('pay.create', $worker->id) }}" class="btn btn-success mt-3">إضافة مدفوعات</a>

                <!-- Add another row for other worker details -->

            </div>


            <div class="row">
                <!-- جدول المدفوعات -->
                <div class="col-md-6">
                    <h4 class="text-right">المدفوعات:</h4>

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
                                    {{-- <td>{{ $payment->paid_at->toDateString()->locale('ar')->isoFormat('dddd') }}</td> --}}
                                    <td>{{ \Carbon\Carbon::parse($payment->paid_at)->toDateString() }}
                                        {{ \Carbon\Carbon::parse($payment->paid_at)->locale('ar')->isoFormat('dddd') }}
                                    </td>
                                    <td>{{ number_format($payment->amount, 2) }} جنيه</td>
                                    <td>
                                        <a href="{{ route('pay.edit', $payment->id) }}" class="btn btn-primary">تعديل</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- جدول سجل الأجور -->
                <div class="col-md-6">
                    <h4 class="text-right">سجل الأجور:</h4>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-right">اليوم</th>
                                <th class="text-right">الأجر</th>
                                <th class="text-right">الاضافي</th>
                                <th class="text-right">الإجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($worker_details) --}}
                            @foreach ($worker_details as $detail)
                                <tr>
                                    <td>{{ $detail->created_at->toDateString() }}

                                        {{ \Carbon\Carbon::parse($detail->created_at)->locale('ar')->isoFormat('dddd') }}
                                    </td>
                                    <td>{{ number_format($detail->daily_wage, 2) }} جنيه</td>
                                    <td>{{ number_format($detail->overtime_hours, 2) }} جنيه</td>
                                    <td>
                                        <a href="{{ route('workers.edit', [$worker->id, $detail->id]) }}"
                                            class="btn btn-primary">تعديل</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <!-- إضافة مدفوعات جديدة -->
            {{-- <a href="{{ route('pay.create', $worker->id) }}" class="btn btn-success mt-3">إضافة مدفوعات</a> --}}
        </div>
    </div>
    </div>
@endsection
