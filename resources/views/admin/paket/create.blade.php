<form method="POST" action="{{ isset($paket) ? route('admin.paket.update', $paket) : route('admin.paket.store') }}">
    @csrf
    @if(isset($paket)) @method('PUT') @endif
    <input type="text" name="nama_paket" placeholder="Nama" value="{{ $paket->nama_paket ?? '' }}">
    <textarea name="deskripsi" placeholder="Deskripsi">{{ $paket->deskripsi ?? '' }}</textarea>
    <input type="number" name="harga" placeholder="Harga" value="{{ $paket->harga ?? '' }}">
    <textarea name="keterangan">{{ $paket->keterangan ?? '' }}</textarea>

    <label>Fitur (pisahkan per baris):</label>
    <textarea name="fitur[]">@if(isset($paket)){{ implode("\n", $paket->fitur) }}@endif</textarea>

    <input type="number" name="urutan" value="{{ $paket->urutan ?? 0 }}">
    <label>Status: <input type="checkbox" name="status" value="1" {{ isset($paket) && $paket->status ? 'checked' : '' }}></label>
    <label>Featured: <input type="checkbox" name="is_featured" value="1" {{ isset($paket) && $paket->is_featured ? 'checked' : '' }}></label>

    <button type="submit">Simpan</button>
</form>
