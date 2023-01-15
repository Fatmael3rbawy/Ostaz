<?php

namespace App\Repositories;

use App\Interfaces\CityRepositoryInterface;
use App\Models\City;
use Illuminate\Http\Request;

class CityRepository extends BaseRepository implements CityRepositoryInterface
{

    public function __construct(City $model)
    {
        parent::__construct($model);
    }
}