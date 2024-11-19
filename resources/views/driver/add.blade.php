@extends('layouts.lay')

@section('content')
    <div class="main_content_container">
        <div class="main_container main_menu_open">
            <div class="page_content">
                <h1 class="heading_title">إضافة رحلة للسائق: {{ $person->name }}</h1>

                <div class="form">
                    <form action="{{ route('drivers.store', $person->id) }}" method="POST">
                        @csrf

                        <!-- Hidden Person ID -->
                        <input type="hidden" name="person_id" value="{{ $person->id }}">

                        <!-- From and To on the same line -->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="to" class="control-label">إلى</label>
                                <input type="text" name="to" class="form-control" placeholder="وجهة الرحلة" required>
                            </div>
                            <div class="col-md-6">
                                <label for="start_from" class="control-label">من</label>
                                <input type="text" name="start_from" class="form-control" placeholder="نقطة الانطلاق" required>
                            </div>
                        </div>

                        <!-- Fare and Date on the same line -->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="trip_date" class="control-label">تاريخ الرحلة</label>
                                <input type="date" name="trip_date" class="form-control" value="{{ $todayDate }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fare" class="control-label">الأجرة</label>
                                <input type="number" name="fare" class="form-control" step="0.01" placeholder="قيمة الأجرة" required>
                            </div>
                        </div>

                        <!-- Season and Submit Button -->
                        <div class="row ">
                            <div class="col-md-6"style=" padding: 25px; margin-bottom: 20px; ">
                                <button type="submit" class="btn btn-success">إضافة اليومية</button>
                            </div>
                        <div class="col-md-6">
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

                        </div>

                        <!-- Submit Button -->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
