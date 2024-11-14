@extends('layouts.lay')

@section('content')
    <div class="main_content_container">
        <div class="main_container main_menu_open">
            <div class="page_content">
                <h1 class="heading_title">عرض كل الشركات</h1>

                <!-- Search and Add Company in the Same Line -->
                <div class="d-flex justify-content-between mb-3">
                    <!-- Search Form (aligned to the right) -->
                    <form action="{{ route('companies.index') }}" method="GET" class="form-inline navbar-form navbar-left">
                        <input type="text" name="query" class="form-control mr-2" placeholder="بحث باسم الشركة"
                            value="{{ request()->query('query') }}">
                        <button type="submit" class="btn btn-secondary">بحث</button>
                    </form>

                    <!-- Add Company Button (aligned to the left) -->
                    <a href="{{ route('companies.create') }}" class="btn btn-primary">إضافة شركة</a>
                </div>

                <div class="wrap">
                    <table class="table table-bordered">
                        <colgroup>
                            <col style="width: 5%;">
                            <col style="width: 30%;">
                            <col style="width: 25%;">
                            <col style="width: 30%;">
                        </colgroup>
                        <tr>
                            <td>#</td>
                            <td>اسم الشركة</td>
                            <td>الحساب</td>
                            <td>التحكم</td>
                        </tr>

                        <!-- Display Companies Based on Search -->
                        @foreach ($companies as $company)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->account_balance }}</td>
                                <td>
                                    <a href="{{ route('transactions.create', $company->id) }}" class="btn btn-danger">إضافة نقله</a>
                                    <a href="{{ route('pays.create', $company->id) }}" class="btn btn-success">تسديد</a>
                                    <a href="{{ route('companies.show', $company->id) }}" class="btn btn-info">كشف حساب</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
