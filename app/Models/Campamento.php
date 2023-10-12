<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campamento extends Model
{
    use HasFactory;
    protected $table = 'campamentos';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
