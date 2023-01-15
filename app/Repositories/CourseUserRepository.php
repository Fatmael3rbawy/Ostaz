<?php

namespace App\Repositories;

use App\Interfaces\CourseUserRepositoryInterface;
use App\Models\Course;
use App\Models\CourseUser;

class CourseUserRepository extends BaseRepository implements CourseUserRepositoryInterface
{

    public function __construct(CourseUser $model)
    {
        parent::__construct($model);
    }

    public function checkifExist($user_id, $course_id){
        $model = $this->model->where('user_id', $user_id)->where('course_id', $course_id)->first();
        return $model;
    }
    

}