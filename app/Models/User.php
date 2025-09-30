<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nomor_urut',
        'roles_id',
        'name',
        'email',
        'password',
        'telepon',
        'asal_sekolah',
        'jenjang',
        'kelas',
        'alamat',
        'nama_orang_tua',
        'telp_orang_tua',
        'avatar',
        'referal_code',
        'email_verified_at',
        'remember_token',
        'password_otp',
        'password_otp_expires_at',
        'status',
        'last_login'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isComplete()
    {
        // treat profile as complete if siswa fields are set; null/empty otherwise
        return ! (empty($this->asal_sekolah) || empty($this->jenjang) || empty($this->kelas));
    }

    public function profilSiswa()
    {
        return $this->hasOne(ProfilSiswa::class, 'user_id');
    }

    public function profilPengajar()
    {
        return $this->hasOne(ProfilPengajar::class, 'user_id');
    }
    // note: pengajar-specific fields moved out; profilPengajar relation still available if app uses it
}
