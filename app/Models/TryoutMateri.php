<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TryoutMateri extends Model
{
    use HasFactory;

    protected $table = 'tryout_materi';
    protected $primarykey = 'tryout_materi_id';

    protected $fillable = [
        'tryout_id',
        'materi_id',
        'pengajar_id',
        'tryout_materi_deskripsi',
    ];

    public function refMateri()
    {
        return $this->hasOne(Materi::class,  'ref_materi_id','materi_id');
    }
}
