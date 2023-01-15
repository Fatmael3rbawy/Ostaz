<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialization extends Model 
{
    protected $fillable=['name','parent_id','status'];
    protected $table = 'specializations';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany(User::class , 'specialization_user' ,'specialization_id' ,'user_id');
    }

    public function attachments()
    {
        return $this->morphToMany(Attachment::class, 'attachmentable');
    }

    public function mainSpecialization()
    {
        return $this->belongsTo(Specialization::class, 'parent_id', 'id');
    }

    public function subSpecializations()
    {
        return $this->hasMany(Specialization::class, 'parent_id','id');
    }

   
}