<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVehiculo extends Model
{
    use HasFactory;
    protected $table = 'tiposvehiculo';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
