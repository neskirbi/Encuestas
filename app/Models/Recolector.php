<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recolector extends Model
{
    use HasFactory;
    protected $table = 'recolectores';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
