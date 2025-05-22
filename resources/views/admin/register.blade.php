@extends('layouts.auth')

@section('content')
<div class="container mt-5">
    <h2>Register Admin</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.register') }}">
        @csrf
        <div class="mb-3">
            <input type="text" name="name" placeholder="Nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <input type="email" name="email" placeholder="Email" class="form-control" required>
        </div>

        <div class="mb-3">
            <input type="password" name="password" placeholder="Password" class="form-control" required>
        </div>

        <div class="mb-3">
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>

    <div class="d-flex justify-content-between mt-3">
        <a href="{{ route('admin.login') }}" class="btn btn-secondary">Kembali ke Login</a>
    </div>
</div>
@endsection
