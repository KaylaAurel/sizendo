<?php

namespace App\Models;
use App\Models\Paket;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $fillable = [
        'nama_paket', 'deskripsi', 'harga', 'keterangan', 'fitur',
        'urutan', 'status', 'is_featured'
    ];

    protected $casts = [
        'fitur' => 'array',
        'status' => 'boolean',
        'is_featured' => 'boolean',
    ];
}

