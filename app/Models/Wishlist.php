<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model 
{

    protected $table = 'wishlists';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'favourite_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function favourite()
    {
        return $this->belongsTo(User::class, 'favourite_id', 'id');
    }

}