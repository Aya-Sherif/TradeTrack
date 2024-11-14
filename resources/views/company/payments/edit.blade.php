@extends('layouts.lay')

@section('content')
    <div class="main_content_container">
        <div class="main_container main_menu_open">
            <div class="page_content">
                <h1 class="heading_title">{{ $company->name }}</h1>

                <div class="form">
                    <form action="{{ route('pays.update', ['companyId' => $company->id, 'pay' => $payment->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Row for input fields -->
                        <div class="row" style="align-items: flex-end;">
                            <!-- Amount Field -->
                            <div class="form-group col-md-4">
                                <label for="amount" class="control-label">المبلغ</label>
                                <input type="number" name="amount" class="form-control" value="{{ old('amount', $payment->payment_amount) }}" required>
                                @error('amount')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Payment Type Field -->
                            <div class="form-group col-md-4">
                                <label for="payment_type" class="control-label">نوع الدفع</label>
                                <select name="payment_type" class="form-control" required>
                                    <option value="نقدي" {{ old('payment_type', $payment->payment_method) == 'نقدي' ? 'selected' : '' }}>نقداً</option>
                                    <option value="تحويل بنك" {{ old('payment_type', $payment->payment_method) == 'تحويل بنك' ? 'selected' : '' }}>تحويل بنكي</option>
                                </select>
                                @error('payment_type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Date Field -->
                            <div class="form-group col-md-4">
                                <label for="payment_date" class="control-label">التاريخ</label>
                                <input type="date" name="payment_date" class="form-control" value="{{ old('payment_date', $payment->payment_date) }}" required>
                                @error('payment_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    

                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">تعديل المبلغ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
