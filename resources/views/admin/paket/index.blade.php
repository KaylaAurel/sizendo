
<h2>Daftar Paket</h2>
<a href="{{ route('admin.paket.create') }}">Tambah Paket</a>
<table>
  <tr>
    <th>Nama</th><th>Harga</th><th>Aksi</th>
  </tr>
  @foreach($pakets as $paket)
    <tr>
      <td>{{ $paket->nama_paket }}</td>
      <td>Rp {{ number_format($paket->harga) }}</td>
      <td>
        <a href="{{ route('admin.paket.edit', $paket) }}">Edit</a>
        <form action="{{ route('admin.paket.destroy', $paket) }}" method="POST" style="display:inline;">
          @csrf @method('DELETE')
          <button type="submit" onclick="return confirm('Yakin?')">Hapus</button>
        </form>
      </td>
    </tr>
  @endforeach
</table>
