<?php

namespace App\Repositories;

use App\Interfaces\MethodRepositoryInterface;
use App\Models\Method;

class MethodRepository extends BaseRepository implements MethodRepositoryInterface
{

    public function __construct(Method $model)
    {
        parent::__construct($model);
    }


}