<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CondicionMaterial extends Model
{
    use HasFactory;
    protected $table = 'condicionmateriales';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
