<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condonacion extends Model
{
    use HasFactory;
    protected $table = 'condonaciones';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
