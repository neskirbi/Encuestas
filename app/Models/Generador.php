<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generador extends Model
{
    use HasFactory;
    protected $table = 'generadores';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
