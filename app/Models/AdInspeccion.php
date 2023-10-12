<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdInspeccion extends Model
{
    use HasFactory;
    protected $table = 'adinspecciones';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
