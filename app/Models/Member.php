<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'nama_member',
        'email',
        'paket',
        'total',
        'no_wa',
        'sosmed',
        'catatan',
        'status',
        'is_active',     // ditambahkan
        'start_date',    // ditambahkan
        'end_date',      // ditambahkan
    ];

     // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke paket
    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
}
