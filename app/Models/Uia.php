<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Uia extends Authenticatable
{
    use HasFactory;
    protected $table = 'uias';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
