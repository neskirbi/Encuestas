<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planta extends Model
{
    use HasFactory;
    protected $table = 'plantas';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
