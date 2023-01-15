<?php   

namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use App\Traits\ApiTraits;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class BaseRepository implements BaseRepositoryInterface 
{
    use ApiTraits;
    protected $model;
    public const PAGINATE_NUMBER = 15;

    public function __construct(Model $model)     
    {         
        $this->model = $model;
    }

    public function create(array $attributes): Model
    {
        $data = $this->model->create($attributes);
        return $data;
    }

    public function update(array $attributes, $id, $request)
    {
        $model = $this->model->find($id);
        if (!isset($model)){
            if (!$request->expectsJson()) {
                throw new ModelNotFoundException("Model not found");
            }
            return abort($this->responseJsonFailed('Model Not Found', 404));
        }
        $data = $model->update($attributes);
        return $data;
    }

    public function find($id, $request ): ?Model
    {
        $model = $this->model->find($id);
        if (!isset($model)){
            if (!$request->expectsJson()) {
                throw new ModelNotFoundException("Model not found");
            }
            return abort($this->responseJsonFailed('Model Not Found', 404));
        }
        return $this->model->find($id);
    }

    public function all(): Collection
    {
        //return $this->model->query()->get();
        return $this->model->all();
    }

    public function allWithPaginate($number = BaseRepository::PAGINATE_NUMBER){
        return $this->model->paginate($number);
    }

    public function BaseSearch($request){
        $query = $this->model;
        foreach ($this->model->getFilters() as $filter) {
            if (isset($request[$filter])) {
                $query = $query->$filter($request[$filter]);
            }
        }   
        return $query;
    }

    public function allWithPaginateExcept($id, $number = BaseRepository::PAGINATE_NUMBER){
        return $this->model->where('id', '!=',  $id)->paginate($number);
    }

    public function takeWithCondition($pramter, $value, $number = 15, $orderBy = 'id', $orderByValue ='DESC'){
        return $this->model->where($pramter,$value)->take($number)->orderBy($orderBy, $orderByValue)->get();
    }

    public function destroy($id, $request)
    {
        $model = $this->model->find($id);
        if (!isset($model)){
            if (!$request->expectsJson()) {
                throw new ModelNotFoundException("Model not found");
            }
            return abort($this->responseJsonFailed('Model Not Found', 404));
        }
        return $model->delete();
    }

    public function groupBy($key){
        return $this->model->get()->groupBy($key)->toArray();
    }

    public function findBy($request , $field_name, $field){
        $model = $this->model->where($field_name, $field)->first();
        if (!isset($model)){
            if (!$request->expectsJson()) {
                throw new ModelNotFoundException("Model not found");
            }
            return abort($this->responseJsonFailed('Model Not Found', 404));
        }
        return $model;
    }


    public function has($key, $op, $value){
        return $this->model->has($key, $op , $value);
    }

    public function withCount($key){
        return $this->model->withCount($key);
    }


}
