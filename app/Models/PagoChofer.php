<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoChofer extends Model
{
    use HasFactory;
    
    protected $table = 'pagoschof';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
