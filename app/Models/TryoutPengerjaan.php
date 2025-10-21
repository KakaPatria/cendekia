<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TryoutPengerjaan extends Model
{
    use HasFactory;

    protected $table = 'tryout_pengerjaan';
    protected $primaryKey = 'tryout_pengerjaan_id'; 

    protected $fillable = [
        'tryout_materi_id',
        'tryout_soal_id',
        'user_id',
        'tryout_jawaban',
        'status', 
        'point'
    ];

    public function soal(){

        return $this->hasOne(TryoutSoal::class,'tryout_soal_id','tryout_soal_id');
    }

    public function getStatusBadgeAttribute(){

        if ($this->status == 'Benar') {
            return '<span class="badge text-bg-success">Benar</span>';
        }else{
            return '<span class="badge text-bg-danger">Salah</span>';
        }
    }
}
