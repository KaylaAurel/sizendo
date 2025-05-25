@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <h3 class="mb-4">Tambah Testimonial</h3>
    <form action="{{ route('admin.testimonial.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nama -->
        <div class="mb-3">
            <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
            <input type="text" name="nama" class="form-control" placeholder="Contoh: Rina Amelia" required>
        </div>

        <!-- Profesi -->
        <div class="mb-3">
            <label for="profesi" class="form-label">Profesi <span class="text-danger">*</span></label>
            <input type="text" name="profesi" class="form-control" placeholder="Contoh: Desainer Grafis" required>
        </div>

        <!-- Rating -->
        <div class="mb-3">
            <label for="rating" class="form-label">Rating <span class="text-danger">*</span></label>
            <select name="rating" class="form-select" required>
                <option value="">Pilih rating</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }} Bintang</option>
                @endfor
            </select>
        </div>

        <!-- Pesan -->
        <div class="mb-3">
            <label for="pesan" class="form-label">Pesan <span class="text-danger">*</span></label>
            <textarea name="pesan" rows="4" class="form-control" placeholder="Tulis testimonial Anda di sini..." required></textarea>
        </div>

        <!-- Foto -->
        <div class="mb-3">
            <label for="foto" class="form-label">Foto (Opsional)</label>
            <input class="form-control" type="file" name="foto" accept="image/png, image/jpeg">
            <small class="text-muted">Format JPG/PNG, maksimal 2MB.</small>
        </div>

        <!-- Tombol Submit -->
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Simpan Testimonial</button>
            <a href="{{ route('admin.testimonial.index') }}" class="btn btn-secondary ms-2">Kembali</a>
        </div>
    </form>
</div>
@endsection
