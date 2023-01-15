<?php

namespace App\Repositories;

use App\Interfaces\DeviceTokenRepositoryInterface;
use App\Models\DeviceToken;
use Illuminate\Http\Request;

class DeviceTokenRepository extends BaseRepository implements DeviceTokenRepositoryInterface
{

    public function __construct(DeviceToken $model)
    {
        parent::__construct($model);
    }

    public function checkifExist($device_token, $user_id){
        $model = $this->model->where('user_id', $user_id)->where('device_token', $device_token)->first();
        return $model;
    }

}