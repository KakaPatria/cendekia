<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasCendekia extends Model
{
    use HasFactory;
    protected $table = 'kelas_cendekia';
    protected $primaryKey = 'kelas_cendekia_id';

    protected $fillable = [
        'kelas_cendekia_nama',
        'kelas_cendekia_keterangan',
        'jenjang',
        'kelas',
        'status',
    ];

    public function jadwal()
    {
        return $this->hasMany(JadwalCendekia::class, 'kelas_cendekia_id', 'kelas_cendekia_id');
    }

    public function siswaKelas()
    {
        return $this->hasMany(KelasSiswaCendekia::class, 'kelas_cendekia_id', 'kelas_cendekia_id');
    }

    public function getStatusBadgeAttribute()
    { 
        if ($this->status == 'Aktif') {
            return ' <span class="badge badge-soft-info fs-11" id="kelas-status">Aktif</span>';
        } else {
            return '<span class="badge badge-soft-dark fs-11" id="kelas-status">Tidak Aktif</span>';
        }
    }
}
