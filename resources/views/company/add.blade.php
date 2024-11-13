@extends('layouts.lay')

@section('content')
    <div class="main_content_container">
        <div class="main_container main_menu_open">
            <div class="page_content">
                <h1 class="heading_title">إضافة شركة جديدة</h1>

                <!-- Company Create Form -->
                <form action="{{ route('companies.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">اسم الشركة</label>
                        <input type="text" name="name" class="form-control" placeholder="أدخل اسم الشركة" required>
                    </div>
                    <div class="form-group">
                        <label for="account_balance">الرصيد</label>
                        <input type="number" name="account_balance" class="form-control" placeholder="أدخل الرصيد" value="0">
                    </div>
                    <button type="submit" class="btn btn-primary">إضافة شركة</button>
                </form>
            </div>
        </div>
    </div>
@endsection
