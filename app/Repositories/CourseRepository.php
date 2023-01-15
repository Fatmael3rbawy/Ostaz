<?php

namespace App\Repositories;

use App\Interfaces\CourseRepositoryInterface;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{

    public function __construct(Course $model)
    {
        parent::__construct($model);
    }

}