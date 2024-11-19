@extends('layouts.lay')

@section('content')
    <div class="main_content_container">
        <div class="main_container main_menu_open">
            <div class="page_content">
                <h1 class="heading_title">إضافة يومية للعامل: {{ $person->name }}</h1>

                <div class="form">
                    <form action="{{ route('workers.store', $person->id) }}" method="POST">
                        @csrf

                        <!-- Daily Wage Field -->
                        <div class="row">


                            <!-- Overtime Hours Field -->
                            <div class="form-group col-md-4">
                                <label for="overtime_hours" class="control-label">ساعات العمل الإضافية</label>
                                <input type="number" name="overtime_hours" class="form-control">
                                @error('overtime_hours')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Date Field -->
                            <div class="form-group col-md-4">
                                <label for="date" class="control-label">التاريخ</label>
                                <input type="date" name="date" class="form-control" required>
                                @error('date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="daily_wage" class="control-label">الأجر اليومي</label>
                                <input type="number" name="daily_wage" class="form-control" required>
                                @error('daily_wage')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
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

                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">إضافة اليومية</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
