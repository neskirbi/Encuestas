<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dosificador extends Authenticatable
{
    use HasFactory;
    protected $table = 'dosificadores';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
