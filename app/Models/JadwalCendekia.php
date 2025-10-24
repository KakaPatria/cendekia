<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalCendekia extends Model
{
    use HasFactory;
    protected $table = 'jadwal_cendekia';
    protected $primarykey = 'jadwal_cendekia_id';

    protected $fillable = [
        'ref_materi_id',
        'guru_id',
        'jadwal_cendekia_hari',
        'jadwal_mulai',
        'jadwal_selesai',
        'jadwal_cendekia_keterangan',
    ];
}
