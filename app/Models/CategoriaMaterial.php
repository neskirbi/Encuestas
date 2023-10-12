<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaMaterial extends Model
{
    use HasFactory;
    protected $table = 'categoriasmaterial';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
