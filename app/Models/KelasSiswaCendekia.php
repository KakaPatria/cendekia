<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasSiswaCendekia extends Model
{
    use HasFactory;
    protected $table = 'kelas_siswa_cendekia';
    protected $primaryKey = 'kelas_siswa_cendekia_id';

    protected $fillable = [
        'kelas_cendekia_id',
        'siswa_id'
    ];

    public function kelas()
    {
        return $this->belongsTo(KelasCendekia::class, 'kelas_cendekia_id', 'kelas_cendekia_id');
    }

    public function siswa()
    {
        return $this->hasOne(User::class, 'id', 'siswa_id')
            ->where('roles_id', '1');
    }


}
