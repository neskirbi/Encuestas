<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    use HasFactory;
    protected $table = 'encuestas';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
