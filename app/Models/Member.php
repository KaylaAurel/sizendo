<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_member', 
        'email', 
        'paket', 
        'no_wa', 
        'sosmed', // Menambahkan sosmed
        'catatan',
    ];
}
