@extends('layouts.lay')

@section('content')
<div class="main_content_container">
    <div class="main_container main_menu_open">
        <div class="page_content">

            <h1 class="heading_title">تعديل البضاعة</h1>
            @include('layouts.message')

            <div class="form">
                <form class="form-horizontal" action="{{ route('goods.update', ['merchant_id' => $good->merchant_id, 'good' => $good->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row" style="display: flex; justify-content: flex-start; align-items: flex-start;">
                        <!-- Weight Field -->
                        <div class="form-group col-md-5">
                            <label for="weight" class="control-label bring_right left_text">الوزن</label>
                            <input type="number" name="weight" id="weight" class="form-control"
                                   value="{{ old('weight', $good->weight) }}" required step="1">
                            @error('weight')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price Per KG Field -->
                        <div class="form-group col-md-5">
                            <label for="price_per_kg" class="control-label bring_right left_text">السعر لكل كيلو</label>
                            <input type="number" name="price_per_kg" id="price_per_kg" class="form-control"
                                   value="{{ old('price_per_kg', $good->price_per_kg) }}" required step="1">
                            @error('price_per_kg')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Total Price Field -->
                        <div class="form-group col-md-5">
                            <label for="total_price" class="control-label bring_right left_text">السعر الكلي</label>
                            <input type="number" name="total_price" id="total_price" class="form-control"
                                   value="{{ old('total_price', $good->total_price) }}" readonly step="1">
                            @error('total_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="row" style="display: flex; justify-content: flex-start; align-items: flex-start;">
                        <!-- Date Field -->
                        <div class="form-group col-md-3">
                            <label for="date" class="control-label bring_right left_text">التاريخ</label>
                            <input type="date" name="date" class="form-control" value="{{ old('date', $good->date) }}" required>
                            @error('date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-3" style="margin-top: 25px;">
                            <button type="submit" class="btn btn-success">تحديث البضاعه</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
    // Function to calculate total_price automatically with AJAX
    document.getElementById('weight').addEventListener('input', calculateTotal);
    document.getElementById('price_per_kg').addEventListener('input', calculateTotal);

    function calculateTotal() {
        var weight = document.getElementById('weight').value;
        var price_per_kg = document.getElementById('price_per_kg').value;

        // Calculate total_price
        if (weight && price_per_kg) {
            var total_price = weight * price_per_kg;
            document.getElementById('total_price').value = total_price.toFixed(0); // Round to integer
        } else {
            document.getElementById('total_price').value = ''; // Clear if inputs are missing
        }
    }
</script>

@endsection
