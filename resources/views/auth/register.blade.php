@extends('layouts.main')

@section('title')
    Register
@endsection

@section('content')
    <div class="register-body">
        <h3 class="text-center mb-3">Welcome to 10-Min Diary</h3>
        <div class="d-flex justify-content-center">
            <form method="post" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-1" >
                    <label class="form-label" for="name">Name</label>
                    <input type="name" id="name" name="name" class="form-control" value="{{ old('name') }}">
                </div>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <!-- Email Address -->
                <div class="mb-1" >
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <!-- Password -->
                <div class="mb-1">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <!-- Confirm Password -->
                <div class="mb-1">
                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                </div>
                @error('password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <!-- Already registered? -->
                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>

                <!-- Register -->
                <div class="mt-3 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary btn-block col-12">Register</button>
                </div>
            </form>
        </div>
    </div>
@endsection
