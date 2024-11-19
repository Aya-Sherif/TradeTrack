@extends('layouts.lay')

@section('content')
    <div class="main_content_container">
        <div class="main_container main_menu_open">
            <div class="page_content">
                <h1 class="heading_title">عرض كل العمال</h1>

                <!-- Search and Add Worker in the Same Line -->
                <div class="d-flex justify-content-between mb-3">
                    <!-- Search Form -->
                    <form action="{{ route('workers.index') }}" method="GET" class="form-inline navbar-form navbar-left">
                        <input type="text" name="query" class="form-control mr-2" placeholder="بحث باسم العامل"
                            value="{{ request()->query('query') }}">
                        <button type="submit" class="btn btn-secondary">بحث</button>
                    </form>

                    <!-- Add Worker Button -->
                    <a href="{{ route('people.create') }}" class="btn btn-primary">إضافة عامل</a>
                </div>

                <!-- Workers Table -->
                <div class="wrap">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم العامل</th>
                                <th>الرصيد</th>
                                <th>التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($workers as $worker)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $worker->name }}</td>
                                    <td>{{ number_format($worker->account_balance, 2) }} جنيه</td>
                                    <td>
                                        <!-- Actions -->
                                        <a href="{{ route('workers.show', $worker->id) }}" class="btn btn-info">كشف حساب</a>
                                        <a href="{{ route('workers.create', $worker->id) }}" class="btn btn-success">إضافة يوم</a>
                                        {{-- <a href="{{ route('payments.create', $worker->id) }}" class="btn btn-danger">تسديد</a> --}}
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
