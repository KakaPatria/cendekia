<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TryoutOpenPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'tryout_open_pendaftaran';
    protected $primaryKey = 'top_id';


    protected $fillable = [
        'tryout_id',
        'top_email',
        'top_nama_siswa',
        'top_asal_sekolah',
        'top_telpon_siswa',
        'top_nama_orang_tua',
        'top_telpon_orang_tua',
        'top_tanggal_bayar',
        'top_jenis_bayar',
        'top_bukti_bayar',
        'top_nama_bayar',
        'top_status',
    ];

    public function tryoutMaster()
    {
        return $this->hasOne(Tryout::class,  'tryout_id', 'tryout_id');
    }


    public function getTanggalBayarFormatAttribute()
    {

        return $this->top_tanggal_bayar ? Carbon::parse($this->top_tanggal_bayar)->format('d M Y') : '';
    }

    public function getStatusBadgeAttribute()
    {

        if ($this->top_status == 'Terverifikasi') {
            return '<span class="badge text-bg-success">Terverifikasi</span>';
        } else {
            return '<span class="badge text-bg-warning">Pending</span>';
        }
    }
}
