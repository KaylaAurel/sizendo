@extends('layouts.admin')

@section('title', 'Tambah Admin')

@section('content')
    <h2>Tambah Admin Baru</h2>

    <form action="{{ route('admin.pengaturan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.pengaturan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
