<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TryoutPeserta extends Model
{
    use HasFactory;
    protected $table = 'tryout_peserta';
    protected $primaryKey = 'tryout_peserta_id';

    protected $fillable = [
        'user_id',
        'tryout_id',
        'tryout_peserta_name',
        'tryout_peserta_telpon',
        'tryout_peserta_email',
        'tryout_peserta_alamat',
        'tryout_peserta_status',
    ];

    public function masterTryout()
    {
        return $this->hasOne(Tryout::class,  'tryout_id', 'tryout_id');
    }

    public function siswa(){
        return $this->hasOne(User::class,  'id', 'user_id');
    }

    public function getTanggalDaftarAttribute($value)
    {
         
        return Carbon::parse($this->created_at)->format('d M Y H:i');
    }
}
