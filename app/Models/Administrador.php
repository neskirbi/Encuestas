<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrador extends Authenticatable
{
    use HasFactory;
    protected $table = 'administradores';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
