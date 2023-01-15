<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Method\CreateRequest;
use App\Http\Resources\MethodResource;
use App\Interfaces\MethodRepositoryInterface;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;

class MethodController extends Controller
{
    use ApiTraits;
    private $methodRepository;
    public function __construct(MethodRepositoryInterface $methodRepository)
    {
        $this->methodRepository = $methodRepository;
    }

    public function store(CreateRequest $request){
        $data = $this->methodRepository->create($request->all());
        return $this->responseJson(new MethodResource($data));
    }


    public function list(){
        $data = $this->methodRepository->all();
        return $this->responseJson(MethodResource::collection($data));
    }
}
