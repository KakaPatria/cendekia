<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TryoutJawaban extends Model
{
    use HasFactory;

    protected $table = 'tryout_jawaban';
    protected $primaryKey = 'tryout_jawaban_id';

    protected $fillable = [
        'tryout_materi_id',
        'tryout_soal_id',
        'tryout_jawaban_prefix',
        'tryout_jawaban_urutan',
        'tryout_jawaban_isi',
    ];
}
