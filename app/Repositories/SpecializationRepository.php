<?php

namespace App\Repositories;

use App\Interfaces\SpecializationRepositoryInterface;
use App\Models\Specialization;
use App\Traits\HelperTrait;

class SpecializationRepository extends BaseRepository implements SpecializationRepositoryInterface
{
    public function __construct(Specialization $model)
    {
      parent::__construct($model);
    }

    public function mainSpecialization()
    {
        return $this->model->where('parent_id', null)->with('subSpecializations')->get();

    }
    
    public function subSpecialization()
    {
        return $this->model->where('parent_id', '!=', null)->with('mainSpecialization')->get();
    }

    public function mainSpecializationWithPaginate()
    {
        return $this->model->where('parent_id', null)->with('subSpecializations')->paginate();

    }

    public function subSpecializationWithPaginate()
    {
        return $this->model->whereNotNull('parent_id')->with('mainSpecialization')->paginate();
    }

    public function subOfSpecificSpecialization($id){
        return $this->model->where('parent_id', $id)->get();
    }
    
}