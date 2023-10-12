<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendedor extends Authenticatable
{
    use HasFactory;
    protected $table = 'vendedores';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
