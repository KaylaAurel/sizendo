<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $fillable = ['nama', 'harga', 'deskripsi', 'fitur', 'popular'];

    protected $casts = [
        'fitur' => 'array',
        'popular' => 'boolean',
    ];
}
