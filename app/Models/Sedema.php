<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sedema extends Authenticatable
{
    use HasFactory;
    protected $table = 'sedemas';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
