<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Interfaces\CityRepositoryInterface;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use ApiTraits;
    private $cityRepository;
    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }


    public function list(){
        $data = $this->cityRepository->all();
        return $this->responseJson(CityResource::collection($data));
    }
}
