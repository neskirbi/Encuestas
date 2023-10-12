<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidenteObra extends Model
{
    use HasFactory;
    protected $table = 'residentesobras';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
