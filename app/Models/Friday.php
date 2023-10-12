<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friday extends Model
{
    use HasFactory;
    protected $table = 'fridays';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
