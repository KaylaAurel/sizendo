@extends('layouts.admin')

@section('title', 'Edit Paket')

@section('content')
<div class="container">

    <h4>Edit Paket: {{ $paket->nama }}</h4>

    <form action="{{ route('admin.paket.update', $paket->id) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="mb-3">
            <label>Nama Paket</label>
            <input type="text" name="nama" class="form-control" value="{{ $paket->nama }}">
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $paket->harga }}">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $paket->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label>Fitur (pisahkan dengan enter)</label>
            @php
                $fiturArray = is_array($paket->fitur) ? $paket->fitur : explode(',', $paket->fitur ?? '');
            @endphp
            <textarea name="fitur" class="form-control" rows="4">{{ implode("\n", $fiturArray) }}</textarea>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="popular" class="form-check-input" {{ $paket->popular ? 'checked' : '' }}>
            <label class="form-check-label">Tandai sebagai paket populer</label>
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>

</div>
@endsection
