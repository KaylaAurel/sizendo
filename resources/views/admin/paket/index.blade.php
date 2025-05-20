@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Manajemen Paket Keanggotaan</h4>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nama Paket</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Fitur</th>
                <th>Populer</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pakets as $paket)
            <tr>
                <td>{{ $paket->nama }}</td>
                <td>Rp{{ number_format($paket->harga, 0, ',', '.') }}</td>
                <td>{{ $paket->deskripsi }}</td>
                <td>
                    <ul>
                        @foreach($paket->fitur as $f)
                        <li>{{ $f }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $paket->popular ? 'Ya' : 'Tidak' }}</td>
                <td>
                    <a href="{{ route('admin.paket.edit', $paket->id) }}" class="btn btn-warning btn-sm">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
