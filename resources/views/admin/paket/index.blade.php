@extends('layouts.admin')

@section('title', 'Manajemen Paket')

@section('content')
<div class="container-fluid px-4 mt-4">
    <h4 class="fw-semibold mb-3" style="padding-bottom: 4rem">Manajemen Paket</h4>

    <a href="{{ route('admin.paket.create') }}" class="btn btn-primary mb-3" st>Tambah Paket</a>

    <div class="table-responsive shadow-sm rounded bg-white p-3" >
        <table class="table table-bordered table-hover align-middle w-100">
            <thead class="table-light">
                <tr>
                    <th>Nama Paket</th>
                    <th>Deskripsi</th>
                    <th style="width: 300px;">Fitur</th>
                    <th>Harga</th>
                    <th>Durasi</th>
                    <th>Populer</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pakets as $paket)
                    <tr>
                        <td class="fw-medium">{{ $paket->nama }}</td>
                        <td>{{ $paket->deskripsi }}</td>
                        <td style="white-space: normal;">
                            @php
                                $fiturList = is_array($paket->fitur) ? $paket->fitur : explode(',', $paket->fitur ?? '');
                            @endphp
                            @if(count($fiturList) > 0 && !empty($fiturList[0]))
                                <ul class="mb-0 ps-3">
                                    @foreach($fiturList as $fitur)
                                        <li>
                                            @if(Str::startsWith($fitur, '-'))
                                                <span class="text-danger">× {{ ltrim($fitur, '-') }}</span>
                                            @else
                                                <span>✓ {{ $fitur }}</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted fst-italic">Tidak ada fitur</span>
                            @endif
                        </td>
                        <td>Rp{{ number_format($paket->harga, 0, ',', '.') }}</td>
                        <td>{{ $paket->duration }} bulan</td>
                        <td class="text-center">
                            @if($paket->popular)
                                <span class="badge bg-success">Populer</span>
                            @else
                                <span class="badge bg-secondary">-</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.paket.edit', $paket->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.paket.destroy', $paket->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus paket ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada paket tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
