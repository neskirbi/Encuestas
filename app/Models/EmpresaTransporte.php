<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaTransporte extends Model
{
    use HasFactory;
    protected $table = 'empresastransporte';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
