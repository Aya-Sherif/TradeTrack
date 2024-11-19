@extends('layouts.lay')

@section('content')
    <div class="main_content_container">
        <div class="main_container main_menu_open">
            <div class="page_content">
                <h1 class="heading_title">
                    @if (request()->query('role') == 'worker')
                        إضافة عامل جديد
                    @elseif (request()->query('role') == 'driver')
                        إضافة سائق جديد
                    @else
                        إضافة شخص جديد
                    @endif
                </h1>

                <!-- Display form for adding a new person -->
                <div class="form">
                    <form action="{{ route('people.store') }}" method="POST">
                        @csrf

                        <!-- Hidden Input for Role -->
                        <input type="hidden" name="role" value="{{ $role }}">

                        <!-- Name Field -->
                        <div class="row" style="align-items:flex-start;">
                            <!-- Submit Button -->
                            <div class="col-md-3" style="margin-top: 25px;">
                                <button type="submit" class="btn btn-success">
                                    @if ($role == 'driver')
                                        إضافة السائق
                                    @else
                                        إضافة العامل
                                    @endif
                                </button>
                            </div>

                            <div class="col-md-9">
                                <label for="name" class="control-label">
                                    @if ($role == 'driver')
                                        اسم السائق
                                    @else
                                        اسم العامل
                                    @endif
                                </label>
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
