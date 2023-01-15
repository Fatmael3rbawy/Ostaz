<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    public const ATTENDENCE_STATUS = 1;
    public const ABSENT_STATUS = 0;

    protected $fillable = [
        'date',
        'user_id',
        'course_id',
        'status'
    ];

    
}
