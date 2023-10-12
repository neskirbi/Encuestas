<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Asociado extends Authenticatable
{
    use HasFactory;
    protected $table = 'asociados';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
