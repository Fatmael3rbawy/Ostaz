<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model 
{
    use ModelTrait;
    
    public const STATUS_UNPAID = 0;
    public const STATUS_PAID = 1;
    public const STATUS_DUE = 2;
    public const STATUS_REFUND = 3;

    protected $fillable=['date','status','student_id','course_id'];
    protected $table = 'payments';
    public $timestamps = true;

    protected $filters = [
        'PaiedByCourseId',
    ];

    public function student()
    {
        return $this->belongsTo(User::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // public function course()
    // {
    //     return $this->belongsTo(Course::class);
    // }


    public function scopePaiedByCourseId($query, $search){
        return $query->where('course_id', $search)->where('status', Payment::STATUS_PAID);
    }

}