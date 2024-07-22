<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoice';
    protected $primaryKey = 'inv_id';
    public $incrementing = false;

    protected $fillable = [
        'inv_id',
        'user_id',
        'tryout_id',
        'tryout_peserta_id',
        'amount',
        'status',
        'due_date',
        'inv_paid',
    ];

    public function peserta()
    {
        return $this->hasOne(TryoutPeserta::class, 'tryout_peserta_id', 'tryout_peserta_id');
    }

    public function getAmountRpAttribute()
    {
        return number_format($this->amount, 0, ',', '.');
    }
    
    public function getStatusBadgeAttribute()
    {

        if ($this->status == 1) {
            return ' <span class="badge badge-soft-info fs-11" id="payment-status">Lunas</span>';
        } elseif ($this->status == 0) {
            return ' <span class="badge badge-soft-warning fs-11" id="payment-status">Belum Bayar</span>';
        } else {
            return '<span class="badge badge-warning fs-11" id="payment-status">Belum Bayar</span>';
        }
    }
}
