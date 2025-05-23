<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminPengaturanController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin.pengaturan.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.pengaturan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('pengaturan.index')->with('success', 'Admin baru ditambahkan.');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.pengaturan.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $admin->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('pengaturan.index')->with('success', 'Data admin diperbarui.');
    }

    public function destroy($id)
    {
        Admin::destroy($id);
        return back()->with('success', 'Admin dihapus.');
    }
}

