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

    public function edit($id)
    {
        $paket = Paket::findOrFail($id);
        return view('admin.paket.edit', compact('paket'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|integer',
            'deskripsi' => 'required',
            'fitur' => 'required|array',
        ]);

        $paket = Paket::findOrFail($id);
        $paket->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'fitur' => $request->fitur,
            'popular' => $request->has('popular'),
        ]);

        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil diperbarui.');
    }
}

