<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoTemp extends Model
{
    use HasFactory;
    protected $table = 'fototemp';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
