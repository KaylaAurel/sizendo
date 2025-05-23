@extends('layouts.admin')

@section('title', 'Edit Admin')

@section('content')
    <h2>Edit Admin</h2>

    <form action="{{ route('admin.pengaturan.update', $admin->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $admin->name }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $admin->email }}" required>
        </div>
        <div class="mb-3">
            <label>Password (biarkan kosong jika tidak diubah)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.pengaturan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
