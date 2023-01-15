<?php

namespace App\Repositories;

use App\Interfaces\WishlistRepositoryInterface;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistRepository extends BaseRepository implements WishlistRepositoryInterface
{

    public function __construct(Wishlist $model)
    {
        parent::__construct($model);
    }

    function check($user_id , $favourite_id ){
       return $this->model->where(['user_id' => $user_id, 'favourite_id' => $favourite_id])->first(); 
    }

    public function allWithPaginate($number = 15){
        $id = Request()->user()->id;
        return $this->model->where('user_id', $id)->pluck('favourite_id');
    }
}