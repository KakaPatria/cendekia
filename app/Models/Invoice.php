<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoice';
    protected $primaryKey = 'invoice_id';

    protected $fillable = [
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
}
