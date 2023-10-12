<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Microgenerador extends Model
{
    use HasFactory;
    protected $table = 'microgeneradores';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
