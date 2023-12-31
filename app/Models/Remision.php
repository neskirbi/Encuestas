<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remision extends Model
{
    use HasFactory;
    protected $table = 'remisiones';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
