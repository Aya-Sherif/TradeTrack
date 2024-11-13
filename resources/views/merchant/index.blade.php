@extends('layouts.lay')
@section('content')
    <div class="main_content_container">
        <div class="main_container main_menu_open">
            <div class="page_content">
                <h1 class="heading_title">عرض كل التجار</h1>

                <!-- Search and Add Merchant in the Same Line -->
                <div class="d-flex justify-content-between mb-3">
                    <!-- Search Form (aligned to the right) -->
                    <form action="{{ route('merchants.index') }}" method="GET" class="form-inline navbar-form navbar-left">
                        <input type="text" name="query" class="form-control mr-2" placeholder="بحث باسم التاجر"
                            value="{{ request()->query('query') }}">
                        <button type="submit" class="btn btn-secondary">بحث</button>
                    </form>

                    <!-- Add Merchant Button (aligned to the left) -->
                </div>
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <a href="{{ route('merchants.create') }}" class="btn btn-primary">إضافة تاجر</a>



                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->

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
                            <td>اسم التاجر</td>
                            <td>الحساب</td>
                            <td>التحكم</td>
                        </tr>

                        <!-- Display Merchants Based on Search -->
                        @foreach ($merchants as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->account_balance }}</td>
                                <td>
                                    <a href="{{ route('goods.create', $item->id) }}" class="btn btn-danger">إضافة نقله</a>
                                    <a href="{{ route('payments.create', $item->id) }}" class="btn btn-success">تسديد</a>
                                    <a href="{{ route('merchants.show', $item->id) }}" class="btn btn-info">كشف حساب</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
