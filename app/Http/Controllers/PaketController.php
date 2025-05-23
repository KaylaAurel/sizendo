<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::all();
        return view('admin.paket.index', compact('pakets'));
    }

    public function managePack()
    {
        $pakets = Paket::all();
        return view('admin.managePack', compact('pakets'));
    }

    public function create()
    {
        return view('admin.paket.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'fitur' => 'nullable|string',
            'popular' => 'nullable|boolean',
        ]);

                Paket::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'fitur' => $request->fitur,
            'popular' => $request->has('popular'),
        ]);

        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil ditambahkan.');
    }

    public function edit(Paket $paket)
    {
        return view('admin.paket.edit', compact('paket'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'harga' => 'required|numeric|min:0',
        'deskripsi' => 'nullable|string',
        'fitur' => 'nullable|string',
    ]);

    $paket = Paket::findOrFail($id); // pastikan ini dipanggil sebelum penggunaan $paket

    // Proses fitur menjadi string
    $fiturInput = $request->input('fitur', '');
    $fiturArray = array_filter(array_map('trim', explode("\n", $fiturInput)));
    $fiturString = implode(',', $fiturArray);

    // Assign data ke model
    $paket->nama = $request->input('nama');
    $paket->harga = $request->input('harga');
    $paket->deskripsi = $request->input('deskripsi');
    $paket->fitur = $fiturString;
    $paket->popular = $request->has('popular'); // <-- penempatan yang benar

    $paket->save();

    return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil diperbarui.');
}

    public function destroy(Paket $paket)
    {
        $paket->delete();
        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil dihapus.');
    }
}
