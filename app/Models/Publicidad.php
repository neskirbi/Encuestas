<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Publicidad extends Authenticatable
{
    use HasFactory;  
    protected $table = 'publicidades';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
?>