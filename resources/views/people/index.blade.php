@extends('layouts.lay')

@section('content')
    <div class="main_content_container">
        <div class="main_container main_menu_open">
            <div class="page_content">
                <h1 class="heading_title">عرض كل العمال</h1>

                <!-- Search and Add Company in the Same Line -->
                <div class="d-flex justify-content-between mb-3">
                    <!-- Search Form -->
                    <form action="{{ route('people.index') }}" method="GET" class="form-inline navbar-form navbar-left">
                        <input type="text" name="query" class="form-control mr-2" placeholder="بحث باسم الشخص"
                            value="{{ request()->query('query') }}">
                        <button type="submit" class="btn btn-secondary">بحث</button>
                    </form>

                    <!-- Add Worker/Driver Button -->
                    @if(request()->query('role') == 'worker')
                        <a href="{{ route('people.create') }}" class="btn btn-primary">إضافة عامل</a>
                    @elseif(request()->query('role') == 'driver')
                        <a href="{{ route('people.create') }}" class="btn btn-primary">إضافة سائق</a>
                    @else
                        <a href="{{ route('people.create') }}" class="btn btn-primary">إضافة شخص</a>
                    @endif
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
                            <td>الاسم</td>
                            <td>الحساب</td>
                            <td>التحكم</td>
                        </tr>

                        @foreach ($people as $person) <!-- Updated variable name from 'workers' to 'people' -->
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $person->name }}</td>
                            <td>{{ number_format($person->account_balance, 2) }} جنيه</td>
                            <td>
                                <!-- Actions (Conditional for Role) -->
                                <a href="{{ route('workers.show', ['pearson_id'=>$person->id,'worker'=> $person->id]) }}" class="btn btn-info">كشف حساب</a>
                                @if(request()->query('role') == 'worker')
                                    <a href="{{ route('workers.create', $person->id) }}" class="btn btn-success">إضافة يوم</a>
                                @elseif(request()->query('role') == 'driver')
                                    <a href="{{ route('drivers.create', $person->id) }}" class="btn btn-success">إضافة يوم</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
