<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Finanza extends Authenticatable
{
    use HasFactory;
    protected $table = 'finanzas';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
