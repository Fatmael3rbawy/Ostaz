<?php

namespace App\Repositories;

use App\Interfaces\AreaRepositoryInterface;
use App\Models\Area;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AreaRepository extends BaseRepository implements AreaRepositoryInterface
{

    public function __construct(Area $model)
    {
        parent::__construct($model);
    }

    public function findBy($request , $field_name, $field ){
        $model = $this->model->whereIn($field_name, $field)->get();
        if (!isset($model)){
            if (!$request->expectsJson()) {
                throw new ModelNotFoundException("Model not found");
            }
            return abort($this->responseJsonFailed('Model Not Found', 404));
        }
        return $model;
    }



    public function addArea(Request $request)
    {
        Area::insert([
            'area' => $request->name,
            'city_id' => $request->city_id
        ]);
    }

    public function updateArea(Request $request, $id)
    {
        $area = Area::find($id);
        $area->area = $request->area;
        $area->city_id = $request->city_id;
        $area->save();
    }

    public function allUserLocation($user)
    {
        return $user->areas;   
    }

}