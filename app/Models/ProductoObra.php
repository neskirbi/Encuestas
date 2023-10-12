<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoObra extends Model
{
    use HasFactory;
    protected $table = 'productosobras';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
