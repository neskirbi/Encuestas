<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoCategoria extends Model
{
    use HasFactory;
    protected $table = 'productocategorias';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
