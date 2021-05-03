@extends('layouts.main')

@section('title')
    Sign In
@endsection

@section('content')
    <div class="login-body">
        <h3 class="text-center mb-3">Welcome to 10-Min Diary</h3>
        <div class="d-flex justify-content-center">
            <form method="post" action="{{ route('login') }}">
                @csrf

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

                <!-- Remember Me -->
                {{-- <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div> --}}

                <!-- Forgot your password? -->
                {{-- <div class="flex items-center justify-end mt-3">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div> --}}

                <!-- Don't have an account? -->
                <div class="flex items-center justify-end mt-3">
                    <p><a href="{{ route('register') }}">No account? Please register</a>.</p>
                </div>

                <!-- Sign in -->
                <div class="mt-3 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary btn-block col-12">Sign in</button>
                </div>
            </form>
        </div>
    </div>
@endsection
