@extends('layouts.admin') <!-- Ganti sesuai layout kamu -->

@section('content')
<div class="container my-5">
    <h3 class="mb-4" style="padding-bottom: 4rem">Tambah Testimonial</h3>
    <form action="{{ route('admin.testimonial.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nama -->
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" name="nama" class="form-control" placeholder="Contoh: Rina Amelia">
            </div>
        </div>

        <!-- Profesi -->
        <div class="mb-3 row">
            <label for="profesi" class="col-sm-2 col-form-label">Profesi</label>
            <div class="col-sm-10">
                <input type="text" name="profesi" class="form-control" placeholder="Contoh: Desainer Grafis">
            </div>
        </div>

        <!-- Rating -->
        <div class="mb-3 row">
            <label for="rating" class="col-sm-2 col-form-label">Rating</label>
            <div class="col-sm-10">
                <select name="rating" class="form-select">
                    <option value="">Pilih rating</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} Bintang</option>
                    @endfor
                </select>
            </div>
        </div>

        <!-- Pesan -->
        <div class="mb-3 row">
            <label for="pesan" class="col-sm-2 col-form-label">Pesan</label>
            <div class="col-sm-10">
                <textarea name="pesan" rows="4" class="form-control" placeholder="Tulis testimonial Anda di sini..."></textarea>
            </div>
        </div>

        <!-- Foto -->
        <div class="mb-3 row">
            <label for="foto" class="col-sm-2 col-form-label">Foto</label>
            <div class="col-sm-10">
                <input class="form-control" type="file" name="foto" accept="image/png, image/jpeg">
                <div class="form-text">Opsional. Format JPG/PNG, maksimal 2MB.</div>
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="row">
            <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Simpan Testimonial</button>
            </div>
        </div>
    </form>
</div>
@endsection
