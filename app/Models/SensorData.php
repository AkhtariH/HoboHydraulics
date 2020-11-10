<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Events\DataCreated;

class SensorData extends Model
{
    use HasFactory;
    use Notifiable;
    protected $table = 'sensor_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sensor_id',
        'data',
        'error',
    ];   

    protected $dispatchesEvents = [
        'created' => DataCreated::class,
    ];
}
