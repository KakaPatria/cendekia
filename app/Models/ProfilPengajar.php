<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ProfilPengajar extends Model
{
    use HasFactory;

    /**
     * Ini baris paling penting untuk memperbaiki error 'table not found'.
     * Memberitahu Laravel nama tabel yang benar adalah 'profil_pengajar' (bukan 'profil_pengajars').
     */
    protected $table = 'profil_pengajar';

    /**
     * Mengizinkan semua kolom diisi secara massal (mass assignment).
     */
    protected $guarded = [];

    /**
     * Mendefinisikan relasi bahwa profil ini "milik" satu User.
     */
    public function user()
    {
        // Perbaikan: Seharusnya menggunakan :: (titik dua ganda), bukan . (titik)
        return $this->belongsTo(User::class, 'user_id');
    }
}