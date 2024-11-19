@extends('layouts.lay')

@section('content')
    <div class="main_content_container">
        <div class="main_container main_menu_open">
            <div class="page_content">
                <h1 class="heading_title">إضافة عامل جديد</h1>

                <!-- Display form for adding a new worker -->
                <div class="form">
                    <form action="{{ route('people.store') }}" method="POST">
                        @csrf

                        <!-- Name Field -->
                        <div class="row" style="align-items:flex-start;">
                            <!-- Submit Button -->
                            <div class="col-md-3" style="margin-top: 25px;">
                                <button type="submit" class="btn btn-success">إضافة العامل</button>
                            </div>

                            <div class="col-md-9">
                                <label for="name" class="control-label">اسم العامل</label>
                                <input type="text" name="name" class="form-control" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
