<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recoleccion extends Model
{
    use HasFactory;  
    protected $table = 'recoleccion';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
