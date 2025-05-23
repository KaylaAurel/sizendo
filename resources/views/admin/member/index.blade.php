@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 mt-4">
    <h4 class="fw-semibold mb-3">Daftar Member</h4>

    <div class="table-responsive shadow-sm rounded bg-white p-3">
        <table class="table table-bordered table-hover align-middle w-100">
            <thead class="table-light">
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
                        <td class="fw-medium">{{ $member->nama_member }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->no_wa }}</td>
                        <td><span class="badge bg-primary text-white">{{ $member->paket }}</span></td>
                        <td>
                            @if($member->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            {{ $member->end_date ? \Carbon\Carbon::parse($member->end_date)->format('d-m-Y') : '-' }}
                        </td>
                        <td>
                            @if(!$member->is_active)
                            <form action="{{ route('admin.admin.activate', $member->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-outline-success">Aktifkan</button>
                            </form>
                            @else
                            <form action="{{ route('admin.admin.deactivate', $member->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-outline-danger">Nonaktifkan</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada data member.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
