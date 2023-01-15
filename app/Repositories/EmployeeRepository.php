<?php

namespace App\Repositories;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\User;
use App\Repositories\BaseRepository;


class EmployeeRepository extends BaseRepository implements EmployeeRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function allEmployee($request , $number = 15){
        return $this->model->where(function($query) use($request){
            if($request->filled('email')){
                $query->email($request->email);
            }
            if($request->role_id != 0){
                $query->role($request->role_id);
            }
            if($request->filled('start_date')){
                $query->date($request->start_date, '>=');
            }
            if($request->filled('end_date')){
                $query->date($request->end_date, '<=');
            }
        })->where(['type' => $this->model::TYPE_EMPLOYEE, 'status' => 1])->paginate($number);
    }

    public function assignRole($employee, $role_id){
        return $employee->roles()->sync($role_id);
    }
}