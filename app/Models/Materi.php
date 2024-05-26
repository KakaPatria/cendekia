<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'ref_materi';
    protected $primarykey = 'ref_materi_id';

    protected $fillable = [
        'ref_materi_judul',
        'ref_materi_jenjang',
        'ref_materi_kelas',
    ];
}
