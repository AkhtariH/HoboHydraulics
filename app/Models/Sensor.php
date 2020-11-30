<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'device_id',
        'name',
        'type',
        'active',
        'threshold_value',
        'sensor_type_id',
        'ttn_sensor_id'
    ];
}
