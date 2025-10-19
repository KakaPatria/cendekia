<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


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
        'payment_type',
        'bank',
        'va_number',
        'remark',
    ];

    public function peserta()
    {
        return $this->hasOne(TryoutPeserta::class, 'tryout_peserta_id', 'tryout_peserta_id');
    }

    public function getAmountRpAttribute()
    {
        return number_format($this->amount, 0, ',', '.');
    }

    public function getTotalInvoiceRpAttribute()
    {

        return number_format($this->total, 0, ',', '.');
    }
    public function getDiscountRpAttribute()
    {
        $nominal = $this->getRawOriginal('discount') ?? 0;
        $diskon = $this->getRawOriginal('amount') ?? 0;

        $disocunt = ($nominal * $diskon) / 100;

        return number_format($disocunt, 0, ',', '.');
 
    }

    public function getDueDateFormatAttribute()
    {
        return Carbon::parse($this->due_date)->format('d M Y');
    }

    public function getInvDateFormatAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M Y');
    }

    public function getInvPaidFormatAttribute()
    {
        return Carbon::parse($this->inv_paid)->format('d M Y H:i');
    }

    public function getStatusBadgeAttribute()
    {

        if ($this->status == 1) {
            return ' <span class="badge badge-soft-info fs-11" id="payment-status">Lunas</span>';
        } elseif ($this->status == 0) {
            return ' <span class="badge badge-soft-warning fs-11" id="payment-status">Menunggu Pembayaran</span>';
        } else {
            return '<span class="badge badge-warning fs-11" id="payment-status">Menunggu Pembayaran</span>';
        }
    }
}
