<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TryoutSoal extends Model
{
    use HasFactory;
    protected $table = 'tryout_soal';
    protected $primaryKey = 'tryout_soal_id';
    
    protected $fillable = [
        'tryout_materi_id',
        'tryout_nomor',
        'tryout_soal',
        'tryout_kunci_jawaban',
        'tryout_penyelesaian', 
    ];

    public function materi(){
        return $this->hasOne(TryoutMateri::class,'tryout_materi_id','tryout_materi_id');
    }

    public function jawaban(){
        return $this->hasMany(TryoutJawaban::class,'tryout_soal_id','tryout_soal_id');
    }

    public function pengerjaan()
    {
        return $this->hasOne(TryoutPengerjaan::class,  'tryout_soal_id', 'tryout_soal_id')->where('user_id', Auth::user()->id);
    }
}
