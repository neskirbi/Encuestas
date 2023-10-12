<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransporteObra extends Model
{
    use HasFactory;
    protected $table = 'transporteobras';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
