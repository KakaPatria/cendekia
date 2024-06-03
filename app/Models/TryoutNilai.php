<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TryoutNilai extends Model
{
    use HasFactory;

    protected $table = 'tryout_nilai';
    protected $primaryKey = 'tryout_nilai_id';


    protected $fillable = [
        'tryout_id',
        'tryout_materi_id',
        'user_id',
        'nilai',
        'soal_dijekerjakan',
        'soal_total',
        'jumlah_salah',
        'jumlah_benar',
        'status',
        'mulai_pengerjaan',
        'stop_pengerjaan',
        'lanjutkan_pengerjaan',
        'selesai_pengerjaan',
    ];


    public function getProgresPersenAttribute()
    {
        return ($this->soal_dijekerjakan / $this->soal_total) * 100;
    }

    public function masterTryout()
    {
        return $this->hasOne(Tryout::class,  'tryout_id', 'tryout_id');
    }

    public function siswa()
    {
        return $this->hasOne(User::class,  'id', 'user_id');
    }

    public function getDurasiPengerjaanAttribute()
    {

        $mulai = Carbon::parse($this->mulai_pengerjaan);
        $selesai = Carbon::parse($this->selesai_pengerjaan);

        // Hitung durasi antara waktu mulai dan selesai
        $durasi = $mulai->diff($selesai);

        // Format durasi ke dalam jam, menit, dan detik
        $formattedDurasi = $durasi->format('%H jam %I menit %S detik');

        return $formattedDurasi;
    }
}
