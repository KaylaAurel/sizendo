@extends('layouts.admin')

@section('title', 'Manajemen Testimonial')

@section('content')
<div class="container-fluid px-4 mt-4">
    <h4 class="fw-semibold mb-3" style="padding-bottom: 4rem">Manajemen Testimonial</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.testimonial.create') }}" class="btn btn-primary mb-3">Tambah Testimonial</a>

    <div class="table-responsive shadow-sm rounded bg-white p-3">
        <table class="table table-bordered table-hover align-middle w-100">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Profesi</th>
                    <th>Rating</th>
                    <th>Pesan</th>
                    <th>Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $index => $testimonial)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($testimonial->photo)
                                <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="Foto {{ $testimonial->name }}" width="60" height="60" class="rounded-circle">
                            @else
                                <span class="text-muted fst-italic">Tidak ada foto</span>
                            @endif
                        </td>
                        <td class="fw-medium">{{ $testimonial->name }}</td>
                        <td>{{ $testimonial->profession }}</td>
                        <td>{{ $testimonial->rating }} ⭐</td>
                        <td style="white-space: normal;">{{ $testimonial->message }}</td>
                        <td>{{ $testimonial->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada testimonial tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
