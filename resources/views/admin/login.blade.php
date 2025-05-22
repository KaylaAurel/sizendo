@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg">
                <div class="card-body p-4">
                    <h3 class="card-title text-center mb-4">Admin Login</h3>
                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf
                        <div class="mb-3">
                            <input 
                                type="email" 
                                name="email" 
                                placeholder="Email" 
                                class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                required 
                                autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input 
                                type="password" 
                                name="password" 
                                placeholder="Password" 
                                class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Login</button>
                        </div>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a href="{{ route('admin.register') }}" class="btn btn-outline-secondary btn-sm">Register Admin</a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3 text-muted small">
                &copy; {{ date('Y') }} Sizendo
            </div>
        </div>
    </div>
</div>
@endsection
