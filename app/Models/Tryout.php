<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tryout extends Model
{
    use HasFactory;

    protected $table = 'tryout';
    protected $primaryKey = 'tryout_id';

    protected $fillable = [
        'tryout_judul',
        'tryout_deskripsi',
        'tryout_jenjang',
        'tryout_kelas',
        'tryout_register_due',
        'tryout_banner',
        'tryout_status',
        'tryout_jenis',
        'tryout_nominal',
        'tryout_nominal',
        'is_open',
    ];

    public function materi()
    {

        return $this->hasMany(TryoutMateri::class, 'tryout_id', 'tryout_id');
    }
    public function peserta()
    {

        return $this->hasMany(TryoutPeserta::class, 'tryout_id', 'tryout_id');
    }

    public function nilai()
    {

        return $this->hasMany(TryoutNilai::class, 'tryout_id', 'tryout_id');
    }

    public function getTryoutNominalAttribute($value)
    {
        return number_format($value, 0, ',', '.');
    }

    // Mutator for amount
    public function setTryoutNominalAttribute($value)
    {
        $this->attributes['tryout_nominal'] = str_replace(',', '.', str_replace('.', '', $value));
    }

    // Accessor for transaction_date
    public function getTryoutRegisterDueAttribute($value)
    {
        return Carbon::parse($value)->format('d-M-Y');
    }

    // Mutator for transaction_date
    public function setTryoutRegisterDueAttribute($value)
    {
        $this->attributes['tryout_register_due'] = Carbon::createFromFormat('d-M-Y', $value)->toDateString();
    }

    public function getIsGratisAttribute($value)
    {

        return $this->getRawOriginal('tryout_nominal') ? true : false;
    }
    public function getIsCanRegisterAttribute($value)
    {

        return $this->getRawOriginal('tryout_register_due') <= date('Y-m-d') ? true : false;
        //return true;
    }

    public function getAverageNilai()
    {

        $allNilai = $this->nilai->groupBy('user_id');

        $susunNilai = [];
        foreach ($allNilai as $key => $value) {
            $susunNilai[$key]['siswa'] = $value[0]->siswa;
            $susunNilai[$key]['average'] = $value->avg('nilai');
            $susunNilai[$key]['sum'] = $value->sum('nilai');
            $susunNilai[$key]['total_point'] = $value->sum('total_point');
            $susunNilai[$key]['list'] = $value->keyBy('tryout_materi_id')->toArray();
        }
 
        // Mengurutkan array berdasarkan key 'usia' secara ascending
        usort($susunNilai, function ($a, $b) {
            return $a['total_point'] < $b['total_point'];
        });

        return $susunNilai;
    }

    function getIsRegisteredAttribute()
    {
//dd(auth()->user()->id);
        $peserta = TryoutPeserta::where('user_id', auth()->user()->id)
            ->where('tryout_id', $this->tryout_id)
            ->first();
        //dd($peserta);
        return $peserta;
    }
    function isTerdaftar($id)
    {

        $peserta = TryoutPeserta::where('user_id', auth()->user()->id)
            ->where('tryout_id', $id)
            ->first();
        //dd($peserta);
        return $peserta;
    }
}
