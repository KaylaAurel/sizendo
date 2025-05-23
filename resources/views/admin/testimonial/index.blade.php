@extends('layouts.admin')

@section('title', 'Daftar Testimonial')

@section('content')
<div class="container-fluid px-4 mt-4">
    <h4 class="fw-semibold mb-3">Daftar Testimonial</h4>

    <a href="{{ route('admin.testimonial.create') }}" class="btn btn-primary mb-3">Tambah Testimonial</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow-sm rounded bg-white p-3">
        <table class="table table-bordered table-hover align-middle w-100">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Profesi</th>
                    <th>Rating</th>
                    <th>Pesan</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $testimonial)
                    <tr>
                        <td>{{ $testimonial->name }}</td>
                        <td>{{ $testimonial->profession }}</td>
                        <td>{{ $testimonial->rating }} / 5</td>
                        <td>{{ $testimonial->message }}</td>
                        <td>
                            @if($testimonial->photo)
                                <img src="{{ asset('storage/' . $testimonial->photo) }}" width="60" class="rounded">
                            @else
                                <span class="text-muted">Tidak ada foto</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Belum ada testimonial.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
