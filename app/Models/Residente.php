<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Residente extends Authenticatable
{
    use HasFactory; 
    protected $table = 'residentes';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
