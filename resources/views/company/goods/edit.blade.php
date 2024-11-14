@extends('layouts.lay')

@section('content')
    <div class="main_content_container">
        <div class="main_container main_menu_open">
            <div class="page_content">
                <h1 class="heading_title">{{ $company->name }}</h1>

                <div class="form">
                    <form
                        action="{{ route('transactions.update', ['companyId' => $company->id, 'transaction' => $transaction->id]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Row for input fields -->
                        <div class="row" style="align-items: flex-end;">
                            <!-- Total Cost Field -->
                            <div class="form-group col-md-4">
                                <label for="total_cost" class="control-label">التكلفة الكلية</label>
                                <input type="text" name="total_cost" class="form-control" value="{{ old('total_cost', $transaction->weight * $transaction->price_per_kg) }}" readonly id="total_cost">
                            </div>
                            <!-- Weight Field -->
                            <div class="form-group col-md-4">
                                <label for="weight" class="control-label">الوزن</label>
                                <input type="number" name="weight" class="form-control"
                                    value="{{ old('weight', $transaction->weight) }}" required id="weight">
                                @error('weight')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price per Kg Field -->
                            <div class="form-group col-md-4">
                                <label for="price_per_kg" class="control-label">سعر الكيلو</label>
                                <input type="number" name="price_per_kg" class="form-control"
                                    value="{{ old('price_per_kg', $transaction->price_per_kg) }}" required id="price_per_kg">
                                @error('price_per_kg')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>
                 
                        <div class="row" style="display: flex; justify-content: flex-start; align-items: flex-start;">
                            <!-- Date Field -->
                            <div class="form-group col-md-3">
                                <label for="date" class="control-label bring_right left_text">التاريخ</label>
                                <input type="date" name="date" class="form-control"                                    value="{{ old('date', $transaction->transaction_date) }}" required>

                                @error('date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="col-md-3" style="margin-top: 25px;">
                                <button type="submit" class="btn btn-success">تعديل المعامله</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to calculate total cost -->
    <script>
        const weightField = document.getElementById('weight');
        const pricePerKgField = document.getElementById('price_per_kg');
        const totalCostField = document.getElementById('total_cost');

        function updateTotalCost() {
            const weight = parseFloat(weightField.value) || 0;
            const pricePerKg = parseFloat(pricePerKgField.value) || 0;
            totalCostField.value = (weight * pricePerKg).toFixed(2);
        }

        weightField.addEventListener('input', updateTotalCost);
        pricePerKgField.addEventListener('input', updateTotalCost);
    </script>
@endsection
