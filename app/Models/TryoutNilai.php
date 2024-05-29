<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TryoutNilai extends Model
{
    use HasFactory;

    protected $table = 'tryout_nilai';
    protected $primarykey = 'tryout_nilai_id';

     

    public function masterTryout()
    {
        return $this->hasOne(Tryout::class,  'tryout_id', 'tryout_id');
    }

    public function siswa(){
        return $this->hasOne(User::class,  'id', 'user_id');
    }

    
}
