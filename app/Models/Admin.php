<?php

// app/Models/Admin.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins'; // <- ini penting!
    protected $fillable = ['name', 'email', 'password'];
    public $timestamps = false; // kalau tidak ada kolom created_at dan updated_at
}