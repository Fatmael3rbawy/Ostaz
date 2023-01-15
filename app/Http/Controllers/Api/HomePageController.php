<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SpecializationResource;
use App\Http\Resources\UserResource;
use App\Interfaces\SpecializationRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Traits\ApiTraits;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    use ApiTraits;
    private $speclizationRepo, $userRepo ;
    public function __construct(SpecializationRepositoryInterface $speclizationRepo, UserRepositoryInterface $userRepo)
    {
        $this->speclizationRepo =  $speclizationRepo;
        $this->userRepo =  $userRepo;
    }

    public function index(){
        $data=[
             'categories' => SpecializationResource::collection($this->speclizationRepo->takeWithCondition('parent_id',null, 6 )),
            'most_viewd' => UserResource::collection($this->userRepo->MostViewd()),
            'paid_instructors' => UserResource::collection($this->userRepo->PaidInstructor()), 
        ];
        return $this->responseJson($data);
    }

    public function search(Request $request)
    {
        $users = $this->userRepo->search($request, [User::TYPE_INSTRUCTOR])->get();
        return $this->responseJson(UserResource::collection($users)->response()->getData(true));
    }
}