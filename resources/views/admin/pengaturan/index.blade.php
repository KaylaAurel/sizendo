@extends('layouts.admin')

@section('title', 'Pengaturan Akun')

@section('content')
<div class="container-fluid px-4 mt-4">
    <h4 class="fw-semibold mb-3">Manajemen Admin</h4>

    <a href="{{ route('admin.pengaturan.create') }}" class="btn btn-primary mb-3">Tambah Admin</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow-sm rounded bg-white p-3">
        <table class="table table-bordered table-hover align-middle w-100">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $admin)
                    <tr>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>
                            <a href="{{ route('admin.pengaturan.edit', $admin->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.pengaturan.destroy', $admin->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">Belum ada admin terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
