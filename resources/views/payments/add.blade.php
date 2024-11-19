<!-- resources/views/payments/create.blade.php -->
@extends('layouts.lay')

@section('content')
    <div class="main_content_container">
        <div class="main_container main_menu_open">
            <div class="page_content">
                <h1 class="heading_title">إضافة دفع للمستخدم: {{ $person->name }}</h1>

                <div class="form">
                    <form action="{{ route('pay.store', $person->id) }}" method="POST">
                        @csrf
                        <!-- Payment Amount -->
                        <div class="form-group">
                            <div class="form-group col-md-6">
                                <label for="date" class="control-label">التاريخ</label>
                                <input type="date" name="date" class="form-control" value="{{ \Carbon\Carbon::today()->toDateString() }}" required>
                                @error('date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">

                                <label for="amount" class="control-label">المبلغ المدفوع</label>
                                <input type="number" name="amount" class="form-control" step="1"
                                    placeholder="المبلغ" required>
                                @error('amount')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success">دفع</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
