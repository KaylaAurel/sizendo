<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Ambil semua testimonial terbaru
        $testimonials = Testimonial::latest()->get();
        $pakets = Paket::all();

        return view('home', compact('testimonials', 'pakets'));


    }
}
