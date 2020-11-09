<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBridge extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'user_bridge';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'bridge_id',
    ];    
}
