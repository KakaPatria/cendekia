<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasSiswaCendekia extends Model
{
    use HasFactory;
    protected $table = 'kelas_siswa_cendekia';
    protected $primarykey = 'kelas_siswa_cendekia_id';

    protected $fillable = [
        'kelas_cendekia_id',
        'siswa_id'
    ];
}
