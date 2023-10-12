<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logueo extends Model
{
    use HasFactory;
    protected $table = 'logueos';
    protected $primaryKey = 'id';
    public $incrementing = false;

}
