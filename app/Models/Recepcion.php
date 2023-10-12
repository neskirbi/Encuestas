<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Recepcion extends Authenticatable
{
    use HasFactory;
    protected $table = 'recepciones';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
