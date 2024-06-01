<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function jawaban(){
        return $this->hasMany(TryoutJawaban::class,'tryout_soal_id','tryout_soal_id');
    }
}
