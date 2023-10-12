<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuera extends Model
{
    use HasFactory;
    protected $table = 'fueras';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
