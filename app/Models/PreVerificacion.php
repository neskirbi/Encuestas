<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreVerificacion extends Model
{
    use HasFactory;
    protected $table = 'preverificaciones';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
