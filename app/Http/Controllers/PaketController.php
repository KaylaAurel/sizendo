<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::all();
        return view('admin.paket.index', compact('pakets'));
    }

    public function create()
    {
        return view('admin.paket.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_paket' => 'required|string',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer',
            'keterangan' => 'nullable|string',
            'fitur' => 'required|array',
            'urutan' => 'integer',
            'status' => 'boolean',
            'is_featured' => 'boolean',
        ]);
        $data['fitur'] = array_values($data['fitur']);

        Paket::create($data);
        return redirect()->route('admin.paket.index');
    }

    public function edit(Paket $paket)
    {
        return view('admin.paket.edit', compact('paket'));
    }

   public function update(Request $request, Paket $paket)
{
    $request->validate([
        'nama_paket' => 'required|string|max:255',
        'deskripsi' => 'required',
        'harga' => 'required|integer',
        'fitur' => 'nullable|string',
        'keterangan' => 'nullable|string',
        'urutan' => 'nullable|integer',
        'status' => 'nullable|boolean',
        'is_featured' => 'nullable|boolean',
    ]);

    $paket->update([
        'nama_paket' => $request->nama_paket,
        'deskripsi' => $request->deskripsi,
        'harga' => $request->harga,
        'keterangan' => $request->keterangan,
        'fitur' => array_filter(array_map('trim', explode("\n", $request->fitur))),
        'urutan' => $request->urutan ?? 0,
        'status' => $request->has('status'),
        'is_featured' => $request->has('is_featured'),
    ]);

    return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil diperbarui.');
}

    public function destroy(Paket $paket)
    {
        $paket->delete();
        return redirect()->route('admin.paket.index');
    }
}


