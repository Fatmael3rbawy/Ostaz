<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Wishlist\LikeDislikeRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\WishlistResource;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\WishlistRepositoryInterface;
use App\Models\User;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    use ApiTraits;
    private $WishlistRepository, $userRepository;
    public function __construct(WishlistRepositoryInterface $WishlistRepository, UserRepositoryInterface $userRepository)
    {
        $this->WishlistRepository = $WishlistRepository;
        $this->userRepository = $userRepository;
    }

    public function likeDislike(LikeDislikeRequest $request){
        $data = $this->WishlistRepository->check($request->user()->id, $request->favourite_id);
        if(!$data){
            $user = $this->userRepository->find($request->favourite_id, $request);
            if($user->type == User::TYPE_INSTRUCTOR){
                $data = $this->WishlistRepository->create([
                    'user_id' => $request->user()->id,
                    'favourite_id' => $request->favourite_id,
                ]);
                return $this->responseJsonWithoutData();
            }
            return $this->responseJsonFailed('this id not belong to instructor');
        }
        $this->WishlistRepository->destroy($data->id, $request);
        return $this->responseJson();
    }

    public function list(){
        $data = $this->WishlistRepository->allWithPaginate();
        $users = User::whereIn('id', $data)->paginate(15);
        return $this->responseJson(UserResource::collection($users)->response()->getData(true));
    }
}
