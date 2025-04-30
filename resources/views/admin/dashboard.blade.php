@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @if(session('admin'))
    <h2>Selamat datang, {{ session('admin')['name'] }}</h2>

        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger mt-2">Logout</button>
        </form>
    @else
        <h2>Session admin tidak ditemukan. Silakan login kembali.</h2>
    @endif
</div>
@endsection
