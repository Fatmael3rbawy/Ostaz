<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    use HasFactory, ModelTrait;
    protected $table = 'course_user';

    public const PENDING_STATUS = 1;
    public const ACCEPT_STATUS = 2;
    public const REJECT_STATUS = 3;

    protected $fillable = [
        'pay_status',
        'pay_date',
        'user_id',
        'course_id',
        'status',
    ];

    protected $filters = [
        'CourseId',
    ];

    public function scopeCourseId($query, $search){
        return $query->where('course_id', $search);
    }
}
