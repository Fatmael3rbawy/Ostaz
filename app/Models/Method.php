<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Method extends Model 
{
    protected $table = 'methods';
    public $timestamps = true;

    use SoftDeletes, ModelTrait;

    protected $fillable = [
        'name',
    ];

    protected $filters = [
        'name',
    ];

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeName($query, $search){
        return $query->where('name', 'LIKE', '%' . $search . '%');
    }

}