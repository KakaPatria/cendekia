<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TryoutMateri extends Model
{
    use HasFactory;

    protected $table = 'tryout_materi';
    protected $primaryKey = 'tryout_materi_id';
    public $incrementing = false;

    protected $fillable = [
        'tryout_id',
        'materi_id',
        'pengajar_id',
        'tryout_materi_deskripsi',
        'jenis_soal',
        'periode_mulai',
        'periode_selesai',
        'safe_mode',
        'master_soal',
    ];

    public function tryoutMaster()
    {
        return $this->hasOne(Tryout::class,  'tryout_id','tryout_id');
    }
    public function refMateri()
    {
        return $this->hasOne(Materi::class,  'ref_materi_id','materi_id');
    }

    public function soal()
    {
        return $this->hasMany(TryoutSoal::class,  'tryout_materi_id','tryout_materi_id');
    }
    public function nilai()
    {
        return $this->hasMany(TryoutNilai::class,  'tryout_materi_id','tryout_materi_id');
    }
}
