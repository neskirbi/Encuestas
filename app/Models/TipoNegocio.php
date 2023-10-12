<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoNegocio extends Model
{
    use HasFactory;
    protected $table = 'tiponegocio';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
