<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppKey extends Model
{
    use HasFactory;
    protected $table = 'appkeys';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
