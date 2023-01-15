<?php

namespace App\Repositories;

use App\Interfaces\PermissionRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;


class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{

    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }

}