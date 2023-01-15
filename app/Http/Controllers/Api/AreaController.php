<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AreaResource;
use App\Interfaces\AreaRepositoryInterface;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    use ApiTraits;
    private $areaRepository;
    public function __construct(AreaRepositoryInterface $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }


    public function listByCitiesId(Request $request ){
        //validate cities id
        $data = $this->areaRepository->findBy($request , 'city_id', $request->cities_id);
        return $this->responseJson(AreaResource::collection($data));
    }
}
