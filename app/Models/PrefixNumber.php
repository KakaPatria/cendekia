<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrefixNumber extends Model
{
    use HasFactory;

    protected $table = 'prefix_number';
    protected $primaryKey = 'id';
    public $timestamps  = false;
}
