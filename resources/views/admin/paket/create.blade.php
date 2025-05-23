@extends('layouts.admin')

@section('title', 'Tambah Paket')

@section('content')
    <h4>Tambah Paket Baru</h4>

    <form action="{{ route('admin.paket.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Paket</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="fitur" class="form-label">Fitur (satu baris per fitur, awali dengan "-" untuk fitur tidak tersedia)</label>
            <textarea name="fitur" id="fitur" class="form-control" rows="5" placeholder="-Fitur A\nFitur B\n-Fitur C">{{ old('fitur') }}</textarea>
        </div>


        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga') }}" required>
        </div>

        <div class="mb-3">
            <label for="duration" class="form-label">Durasi (bulan)</label>
            <input type="number" name="duration" id="duration" class="form-control" value="{{ old('duration') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.paket.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
