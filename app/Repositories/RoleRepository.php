<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use App\Repositories\BaseRepository;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{

    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function givePermission(array $attributes, $model){
      $model->permissions()->sync($attributes);
    }

    public function destroyWithCheck($id, $request){
      if (null == $model = $this->model->find($id)) {
          if (!$request->expectsJson()) {
              throw new ModelNotFoundException("Can't Delete");
          }else{
              $this->responseJsonFailed("Can't Delete");
          }
      }
      if ($model->users->count() > 0) {
        throw new ModelNotFoundException("Can't Delete");
      }else{
          $this->responseJsonFailed("Can't Delete");
      }
      return $model->delete();
    }

    public function block($id, $request){
      if (null == $model = $this->model->find($id)) {
          if (!$request->expectsJson()) {
              throw new ModelNotFoundException("Can't Delete");
          }else{
              $this->responseJsonFailed("Can't Delete");
          }
      }
      $model->update([
        'status' => 0,
      ]);
      return $model;
    }

    public function allSearchAble($request ,$filters = ['pagination' => 10,'order' => 'desc']){
      $pagination = $filters['pagination'];
      $order = $filters['order'];
      return $this->model->where(function($query) use($request){
            if($request->filled('name')){
              $query->where('name', 'LIKE', '%' . $request->name . '%');
            }
        })->where('status',1)->orderBy('created_at', $order)->paginate($pagination);
    }


}
