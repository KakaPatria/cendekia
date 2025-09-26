<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ProfilSiswa extends Model
{
    use HasFactory;

    /**
     * Ini baris paling penting untuk memperbaiki error 'table not found'.
     */
    protected $table = 'profil_siswa';

    /**
     * Mengizinkan semua kolom diisi.
     */
    protected $guarded = [];

    /**
     * Mendefinisikan relasi ke User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
