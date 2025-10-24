<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasCendekia extends Model
{
    use HasFactory;
    protected $table = 'kelas_cendekia';
    protected $primarykey = 'kelas_cendekia_id';

    protected $fillable = [
        'kelas_cendekia_nama',
        'kelas_cendekia_keterangan',
    ];
}
