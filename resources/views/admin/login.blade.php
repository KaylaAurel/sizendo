@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Login Admin</h2>
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" placeholder="Email" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" placeholder="Password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    
    <!-- Button Register Admin -->
    <div class="d-flex justify-content-between mt-3">
        <a href="{{ route('admin.register') }}" class="btn btn-secondary">Register Admin</a>
    </div>
</div>
@endsection
