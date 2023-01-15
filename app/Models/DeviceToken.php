<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceToken extends Model
{
    use HasFactory;

    public const ANDROID_TYPE = 1;
    public const IOS_TYPE = 2;

    protected $fillable = [
        'device_token',
        'device_type',
        'user_id',
    ];
}
