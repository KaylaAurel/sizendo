@extends('layouts.auth')

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

    <h4 class="mt-4">Daftar Paket</h4>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama Paket</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Durasi (bulan)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pakets as $paket)
                <tr>
                    <td>{{ $paket->name }}</td>
                    <td>{{ $paket->description }}</td>
                    <td>Rp {{ number_format($paket->price, 0, ',', '.') }}</td>
                    <td>{{ $paket->duration }}</td>
                    <td>
                        <a href="{{ route('admin.paket.edit', $paket->id) }}" class="btn btn-warning btn-sm">Edit Paket</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada paket.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
