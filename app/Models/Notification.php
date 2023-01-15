<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public const PENDING_ACTION = 1;
    public const ACCEPT_ACTION = 2;
    public const REJECT_ACTION = 3;

    protected $fillable = [
        'message',
        'sender_id',
        'course_id',
        'receiver_id',
    ];
}
