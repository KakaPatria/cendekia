<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function pengajar()
    {
        return $this->hasOne(User::class,  'id', 'pengajar_id');
    }
    public function tryoutMaster()
    {
        return $this->hasOne(Tryout::class,  'tryout_id', 'tryout_id');
    }
    public function refMateri()
    {
        return $this->hasOne(Materi::class,  'ref_materi_id', 'materi_id');
    }

    public function soal()
    {
        return $this->hasMany(TryoutSoal::class,  'tryout_materi_id', 'tryout_materi_id');
    }

    public function nilai()
    {
        return $this->hasMany(TryoutNilai::class,  'tryout_materi_id', 'tryout_materi_id');
    }

    public function nilaiSiswa()
    {
        return $this->hasOne(TryoutNilai::class,  'tryout_materi_id', 'tryout_materi_id')->where('user_id',auth()->user()->id);
    }

    public function nilaiUser()
    {
        return $this->hasOne(TryoutNilai::class,  'tryout_materi_id', 'tryout_materi_id')->where('user_id', Auth::user()->id);
    }

    public function getInPeriodeAttribute()
    {
        $status = false;
        if ($this->periode_mulai && $this->periode_selesai) {
            $start = Carbon::parse($this->periode_mulai);
            $end = Carbon::parse($this->periode_selesai);
            $now = Carbon::now();
        
            // Jika tanggal awal lebih besar dari tanggal akhir, tukar nilainya
            if ($start->greaterThan($end)) {
                $temp = $start;
                $start = $end;
                $end = $temp;
            }
        
            // Periksa apakah tanggal sekarang berada dalam rentang tanggal
            return $now->between($start, $end);
        }

        return $status;
    }
    public function getPeriodeAttribute()
    {
        if (!$this->periode_mulai && !$this->periode_selesai) {
            return '';
        } else {
            return Carbon::parse($this->periode_mulai)->format('d') . ' s/d ' . Carbon::parse($this->periode_selesai)->format('d M y');
        }
    }
}
