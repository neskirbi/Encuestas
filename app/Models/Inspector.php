<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Inspector extends Authenticatable
{
    use HasFactory;
    protected $table = 'inspectores';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
