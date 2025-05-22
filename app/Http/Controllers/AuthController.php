<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Tampilkan form login admin
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Proses login admin
    public function login(Request $request)
    {
        // Validasi input login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = DB::table('admins')
            ->where('email', $request->email)
            ->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            // Simpan hanya data penting ke session, jangan simpan password
            session([
    'admin' => (object) [
        'id' => $admin->id,
        'name' => $admin->name,
        'email' => $admin->email,
    ]
]);


            return redirect()->route('admin.dashboard');
        } 

        return back()->withErrors(['message' => 'Email atau password salah'])->withInput();
    }

    // Logout admin
    public function logout()
    {
        session()->forget('admin');
        return redirect()->route('admin.login');
    }

    // Tampilkan form register admin
    public function showRegisterForm()
    {
        return view('admin.register');
    }

    // Proses simpan admin baru
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DB::table('admins')->insert([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.login')->with('success', 'Admin berhasil terdaftar!');
    }
}
