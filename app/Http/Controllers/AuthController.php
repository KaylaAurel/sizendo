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
        // Validasi input login
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = DB::table('admins')
            ->where('email', $request->email)
            ->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            $request->session()->regenerate();
            
            $request->session()->put('admin_data', $admin); // data admin
            
            return redirect()->intended(route('admin.dashboard'));
        }


        return back()->withErrors(['message' => 'Email atau password salah'])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('admin.login'));
    }

    public function showRegisterForm()
    {
        return view('admin.register');
    }

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
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect(route('admin.login'))->with('success', 'Admin berhasil terdaftar!');
    }
}
