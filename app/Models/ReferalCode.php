<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferalCode extends Model
{
    use HasFactory;

    protected $table = 'referal_codes';
    protected $primaryKey = 'code';
    public $incrementing = false;

}
