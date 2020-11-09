<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'bridge_id',
        'name',
        'type',
        'active',
        'threshold_value'
    ];
}
