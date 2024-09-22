@extends('layouts.base')

@section('title')
    Login
@endsection

@section('content')
    <div class="container mt-5 pt-4">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7 col-sm-9">
                <h2 class="text-center mb-4">Login</h2>
                <form id="loginForm" method="POST" action="" class="border p-4 bg-light rounded">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <div class="mt-3 text-center">
                    Not registered? <a href="{{ route('register') }}">Register</a>
                </div>
            </div>
        </div>
    </div>
@endsection
