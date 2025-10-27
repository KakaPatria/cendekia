<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalCendekia extends Model
{
    use HasFactory;
    protected $table = 'jadwal_cendekia';
    protected $primaryKey = 'jadwal_cendekia_id';

    protected $fillable = [
        'kelas_cendekia_id',
        'ref_materi_id',
        'guru_id',
        'jadwal_cendekia_hari',
        'jadwal_mulai',
        'jadwal_selesai',
        'jadwal_cendekia_keterangan',
    ];

    protected $casts = [
        'jadwal_mulai' => 'datetime:H:i',
        'jadwal_selesai' => 'datetime:H:i',
    ];

    public function kelas()
    {
        return $this->belongsTo(KelasCendekia::class, 'kelas_cendekia_id', 'kelas_cendekia_id');
    }

    public function mataPelajaran()
    {
        return $this->hasOne(Materi::class, 'ref_materi_id', 'ref_materi_id');
    }

    public function guru()
    {
        return $this->hasOne(User::class, 'id', 'guru_id')
            ->where('roles_id', '3');
    }

    // format output jadwal_mulai
    public function getJadwalMulaiAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('H:i') : null;
    }

    // format output jadwal_selesai
    public function getJadwalSelesaiAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('H:i') : null;
    }


}
