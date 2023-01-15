<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppSettingResource;
use App\Interfaces\AppSettingRepositoryInterface;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    use ApiTraits;
    private $appSettingRepository;
  
    public function __construct(AppSettingRepositoryInterface $appSettingRepository )
    {
        $this->appSettingRepository = $appSettingRepository;
    }

    public function index(Request $request)
    {
        return $this->responseJson(new AppSettingResource($this->appSettingRepository->find(1, $request)));
    }
}
