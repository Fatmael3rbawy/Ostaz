<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model 
{

    protected $table = 'cities';
    public $timestamps = true;

    use SoftDeletes, ModelTrait;

    protected $dates = ['deleted_at'];

    protected $filters = [
        'activeAreas',
        'cityWithAreaByUser',
        'activeAreaCityByUser'
    ];

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }


    public function scopeCity($query, $search){
           return $query->where('id', $search);
        
    }


    public function scopeActiveAreas($query, $search){
        return $query->whereHas('areas', function($query){
            $query->whereHas('users', function($query){
                $query->where('type', User::TYPE_STUDENT)->orWhere('type', User::TYPE_INSTRUCTOR);
            });
        }); 
    }

    public function scopeCityWithAreaByUser($query, $user_id){
        return $query->with(['areas' =>function($q) use($user_id){
            $q->whereHas('users', function($q) use($user_id){
                $q->where('user_id', $user_id);
            });
        }]);
    }

    public function scopeActiveAreaCityByUser($query, $user_id){
        return $query->whereHas('areas', function($q) use($user_id){
            $q->whereHas('users', function($q) use($user_id){
                $q->where('user_id', $user_id);
            });
        });
    }


    
}