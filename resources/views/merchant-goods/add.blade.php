@extends('layouts.lay')

@section('content')
    <div class="main_content_container">
        <div class="main_container main_menu_open">
            <div class="page_content">

                <h1 class="heading_title">إضافة بضاعة للتاجر</h1>
                @include('layouts.message')

                <div class="form">
                    <form class="form-horizontal" action="{{ route('goods.store', $merchant->id) }}" method="POST">
                        @csrf
                        <div class="form-group row">

                            <!-- السعر الكلي -->
                            <div class="col-md-4">
                                <label for="total_price" class="control-label bring_right left_text">السعر الكلي</label>
                                <input type="number" name="total_price" id="total_price" class="form-control"
                                    value="{{ old('total_price') }}" readonly>
                                @error('total_price')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- السعر لكل كيلو -->
                            <div class="col-md-4">
                                <label for="price_per_kg" class="control-label bring_right left_text">السعر لكل كيلو</label>
                                <input type="number" name="price_per_kg" id="price_per_kg" class="form-control"
                                    value="{{ old('price_per_kg') }}" required>
                                @error('price_per_kg')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                                  <!-- الوزن -->
                                  <div class="col-md-4">
                                    <label for="weight" class="control-label bring_right left_text">الوزن</label>
                                    <input type="number" name="weight" id="weight" class="form-control"
                                        value="{{ old('weight') }}" required>
                                    @error('weight')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                        </div>

                        <div class="form-group row">
                            <!-- الموسم -->

                          <div class="col-md-4">
                            <label for="season_id" class="control-label bring_right left_text ">الموسم</label>
                            <select name="season_id" class="form-control " required>
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

                            <!-- Description -->
                            <div class="col-md-4">
                                <label for="description" class="control-label bring_right left_text">تعليق</label>
                                <textarea name="description" class="form-control" rows="2">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- التاريخ -->
                            <div class="col-md-4">
                                <label for="date" class="control-label bring_right left_text">التاريخ</label>
                                <input type="date" name="date" id="date" class="form-control"
                                    value="{{ old('date', \Carbon\Carbon::now()->toDateString()) }}" required>
                                @error('date')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>


                        <div class="form-group">
                            <div class="col-sm-1 col-sm-offset-1">
                                <button type="submit" class="btn btn-success">إضافة بضاعة</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Run the script only after the entire HTML content is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Set up event listeners and confirm they are attached
            const weightInput = document.getElementById('weight');
            const pricePerKgInput = document.getElementById('price_per_kg');
            const totalPriceInput = document.getElementById('total_price');

            // Check if elements are correctly identified
            if (weightInput && pricePerKgInput && totalPriceInput) {
                console.log("Elements found. Adding event listeners.");

                // Attach event listeners and confirm they are working
                weightInput.addEventListener('input', function() {
                    console.log("Weight input changed.");
                    calculateTotal();
                });

                pricePerKgInput.addEventListener('input', function() {
                    console.log("Price per kg input changed.");
                    calculateTotal();
                });
            } else {
                console.error("One or more elements (weight, price_per_kg, or total_price) not found.");
            }

            // Function to calculate total price
            function calculateTotal() {
                // Retrieve and parse values
                const weight = parseFloat(weightInput.value);
                const pricePerKg = parseFloat(pricePerKgInput.value);

                // Log values for debugging
                console.log("Weight:", weight);
                console.log("Price per Kg:", pricePerKg);

                // Validate values and calculate total price
                if (!isNaN(weight) && weight > 0 && !isNaN(pricePerKg) && pricePerKg > 0) {
                    const totalPrice = (weight * pricePerKg).toFixed(2);
                    console.log("Total Price Calculated:", totalPrice);
                    totalPriceInput.value = totalPrice;
                } else {
                    console.log("Invalid input: Clearing total price.");
                    totalPriceInput.value = ''; // Clear if inputs are invalid
                }
            }
        });
    </script>
@endsection
