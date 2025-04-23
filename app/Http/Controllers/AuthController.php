<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // untuk hash password
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $admin = DB::table('admins')
            ->where('email', $request->email)
            ->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session(['admin' => $admin]);
            return redirect('/admin/dashboard');
        } else {
            return back()->withErrors(['message' => 'Email atau password salah']);
        }
    }

    public function logout()
    {
        session()->forget('admin');
        return redirect('/admin/login');
    }

    // ✅ Tampilkan form register admin
    public function showRegisterForm()
    {
        return view('admin.register');
    }

    // ✅ Proses simpan admin baru
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
        ]);

        return redirect('/admin/login')->with('success', 'Admin berhasil terdaftar!');
    }
}
