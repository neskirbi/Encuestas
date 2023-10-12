<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialObra extends Model
{
    use HasFactory;
    protected $table = 'materialesobra';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $autoincrement = false;
}
