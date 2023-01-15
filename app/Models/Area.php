<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model 
{
    use SoftDeletes, ModelTrait;

    protected $table = 'areas';
    public $timestamps = true;

    protected $fillable = [
        'area',
        'city_id',
    ];


    protected $filters = [
        'cityId',
        'area',
    ];
    
    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function scopeCityId($query, $search){
        return $query->whereHas('city', function (Builder $query) use ($search){
            $query->where('city_id', $search);
        });
    }

    public function scopeArea($query, $search){
        return $query->where('area', 'LIKE', '%' . $search . '%');
    }
}