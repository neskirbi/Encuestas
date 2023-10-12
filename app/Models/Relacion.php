<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relacion extends Model
{
    use HasFactory;
    protected $table = 'relaciones';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
