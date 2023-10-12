<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Director extends Authenticatable
{  
    use HasFactory;
    protected $table = 'directores';
    protected $primaryKey = 'id';
    public $incrementing = false;
    
}
