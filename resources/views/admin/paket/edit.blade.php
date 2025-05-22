<form method="POST" action="{{ route('admin.paket.update', $paket->id) }}">
    @csrf
    @method('PUT')

    <!-- Nama Paket -->
    <div>
        <label>Nama Paket</label>
        <input type="text" name="nama_paket" placeholder="Nama Paket" value="{{ old('nama_paket', $paket->nama_paket) }}">
    </div>

    <!-- Deskripsi -->
    <div>
        <label>Deskripsi</label>
        <textarea name="deskripsi" placeholder="Deskripsi">{{ old('deskripsi', $paket->deskripsi) }}</textarea>
    </div>

    <!-- Harga -->
    <div>
        <label>Harga</label>
        <input type="number" name="harga" placeholder="Harga" value="{{ old('harga', $paket->harga) }}">
    </div>

    <!-- Keterangan -->
    <div>
        <label>Keterangan</label>
        <textarea name="keterangan" placeholder="Keterangan">{{ old('keterangan', $paket->keterangan) }}</textarea>
    </div>

    <!-- Fitur (dari JSON ke teks baris-per-baris) -->
    <div>
        <label>Fitur (pisahkan per baris)</label>
        <textarea name="fitur">{{ old('fitur', is_array($paket->fitur) ? implode("\n", $paket->fitur) : '') }}</textarea>
    </div>

    <!-- Urutan -->
    <div>
        <label>Urutan</label>
        <input type="number" name="urutan" value="{{ old('urutan', $paket->urutan) }}">
    </div>

    <!-- Status Checkbox -->
    <div>
        <label>
            <input type="checkbox" name="status" value="1" {{ old('status', $paket->status) ? 'checked' : '' }}>
            Aktif
        </label>
    </div>

    <!-- Is Featured Checkbox -->
    <div>
        <label>
            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $paket->is_featured) ? 'checked' : '' }}>
            Featured
        </label>
    </div>

    <!-- Submit -->
    <div>
        <button type="submit">Simpan Perubahan</button>
    </div>
</form>
