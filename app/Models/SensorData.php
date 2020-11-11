<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Events\DataCreated;
use Carbon\Carbon;

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
        'threshold_value',
    ];   

    protected $dispatchesEvents = [
        'created' => DataCreated::class,
    ];

    public function getCreatedAtAttribute($value){
        $date = Carbon::parse($value);
        return $date->format('Y-m-d H:i');
    }
    public function getUpdatedAtAttribute($value){
        $date = Carbon::parse($value);
        return $date->format('Y-m-d H:i');
    }
}
