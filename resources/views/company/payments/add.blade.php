@extends('layouts.lay')

@section('content')
<div class="main_content_container">
    <div class="main_container main_menu_open">
        <div class="page_content">

            <h1 class="heading_title">{{ $company->name }}</h1>
            @include('layouts.message')

            <div class="form">
                <form class="form-horizontal" action="{{ route('pays.store', $company->id) }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <!-- Amount -->
                        <div class="col-md-4">
                            <label for="amount" class="control-label bring_right left_text">المبلغ</label>
                            <input type="number" name="amount" class="form-control" value="{{ old('amount') }}" required>
                            @error('amount')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Payment Type -->
                        <div class="col-md-4">
                            <label for="payment_type" class="control-label bring_right left_text">طريقة الدفع</label>
                            <select name="payment_type" class="form-control" required>
                                <option value="نقدي" {{ old('payment_type') == 'نقدي' ? 'selected' : '' }}>نقدي</option>
                                <option value="تحويل بنك" {{ old('payment_type') == 'تحويل بنك' ? 'selected' : '' }}>تحويل بنك</option>
                            </select>
                            @error('payment_type')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Payment Date -->
                        <div class="col-md-4">
                            <label for="payment_date" class="control-label bring_right left_text">التاريخ</label>
                            <input type="date" name="payment_date" class="form-control" value="{{ old('payment_date', \Carbon\Carbon::now()->toDateString()) }}" required>
                            @error('payment_date')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row" style="display: flex; justify-content: flex-start; align-items: flex-start;">


                        <!-- Season -->
                        <div class="col-md-6">
                            <label for="season_id" class="control-label bring_right left_text">الموسم</label>
                            <select name="season_id" class="form-control" required>
                                <option value="">اختر الموسم</option>
                                @foreach($seasons as $season)
                                <option value="{{ $season->id }}" {{ old('season_id', $seasons->first()->id) == $season->id ? 'selected' : '' }}>
                                    {{ $season->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('season_id')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-0 mt-6">
                            <button type="submit" class="btn btn-success">إضافة المبلغ</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
