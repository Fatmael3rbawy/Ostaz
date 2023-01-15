<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, ModelTrait;

    protected $table = 'users';
    public $timestamps = true;
    
    public const TYPE_ADMIN = 1;
    public const TYPE_EMPLOYEE = 2;
    public const TYPE_INSTRUCTOR = 3;
    public const TYPE_PARENT = 4;
    public const TYPE_STUDENT = 5;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'whatsapp',
        'facebook',
        'oauth_id',
        'oauth_type',
        'status',
        'type',
        'otp',
        'last_login_at',
        'views',
    ];

    protected $hidden = [
        'password',
        'oauth_id',
        'oauth_type',
    ];

    protected $filters = [
        'name',
        'type',
    ];

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class);
    }

    public function attachments()
    {
        return $this->morphToMany(Attachment::class, 'attachmentable');
    }

    public function areas()
    {
        return $this->belongsToMany(Area::class);
    }

    public function methods()
    {
        return $this->belongsToMany(Method::class);
    }

    public function instructorCourses()
    {
        return $this->hasMany(Course::class, 'instructor_id', 'id');
    }

    // public function userCourses()
    // {
    //     return $this->hasMany(Course::class, 'user_id', 'id');
    // }

    public function courses()
    {
       // return $this->hasMany(Course::class);
       return $this->belongsToMany(Course::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class ,'student_id');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes["password"] = bcrypt($value);
    }

    public function scopeEmail($query, $search){
        return $query->where('email', 'LIKE', '%' . $search . '%');
    }

    public function scopeName($query, $search){
        return $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%');
    }

    public function scopeType($query, $search){
        return $query->where('type', $search);
    }

    public function scopeSpecialization($query, $search){
        $query->whereHas('specializations', function (Builder $query) use ($search){
            $query->where('specialization_id', $search);
        });
    }


    public function scopeArea($query, $search){
        $query->whereHas('areas', function (Builder $query) use ($search){
            $query->where('area_id', $search);
        });
    }

    public function scopeFeature($query, $search){
        return $query->where('active', $search);
    }

    public function scopeRole($query, $search){
        return $query->whereHas('roles',function($query) use($search){
            $query->where('role_id', $search);
        });
    }
    public function scopeDate($query, $search, $opration){
        return $query->where('created_at', $opration, $search);
    }

    public function cityList($items){
        $list = '';
        foreach($items as $item){
            $list = $list.$item->city->name.',';
        }
        return $list;
    }

    public function areaList($items){
        $list = '';
        foreach($items as $item){
            $list = $list.$item->area.',';
        }
        return $list;
    }

    public function specializationList($items){
        $list = '';
        foreach($items as $item){
            $list = $list.$item->name.',';
        }
        return $list;
    }

    public function devicToken(){
        return $this->hasOne(DeviceToken::class);
    }
}
