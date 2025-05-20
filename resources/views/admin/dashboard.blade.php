@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Selamat datang, {{ session('admin')->name }}</h2>

    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button class="btn btn-danger mt-2">Logout</button>
    </form>

    <hr>

    <h4 class="mt-4">Daftar Member</h4>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>No WA</th>
                <th>Paket</th>
                <th>Status</th>
                <th>Aktif Sampai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($members as $member)
                <tr>
                    <td>{{ $member->nama_member }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->no_wa }}</td>
                    <td>{{ $member->paket }}</td>
                    <td>
                        @if($member->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>
                        @if($member->end_date)
                            {{ \Carbon\Carbon::parse($member->end_date)->format('d-m-Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if(!$member->is_active)
                        <form action="{{ route('admin.activate', $member->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success btn-sm">Aktifkan</button>
                        </form>
                        @else
                        <form action="{{ route('admin.deactivate', $member->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-danger btn-sm">Nonaktifkan</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada member.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <hr>

    {{-- Form Edit Paket --}}
    @if(isset($paket))
    <div class="mt-5">
        <h4>Edit Paket: {{ $paket->name }}</h4>
        <form action="{{ route('admin.paket.update', $paket->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Paket</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $paket->name) }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" name="description" rows="3">{{ old('description', $paket->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" class="form-control" name="price" value="{{ old('price', $paket->price) }}">
            </div>

            <div class="mb-3">
                <label for="duration" class="form-label">Durasi (bulan)</label>
                <input type="number" class="form-control" name="duration" value="{{ old('duration', $paket->duration) }}">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
    @endif
</div>
@endsection
