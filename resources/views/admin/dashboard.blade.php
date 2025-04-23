@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Selamat datang, {{ session('admin')->name }}</h2>
    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button class="btn btn-danger mt-2">Logout</button>
    </form>
</div>
@endsection
