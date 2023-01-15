<?php

namespace App\Repositories;

use App\Interfaces\AppSettingRepositoryInterface;
use App\Models\AppSetting;
use App\Traits\ApiTraits;

class AppSettingRepository extends BaseRepository implements AppSettingRepositoryInterface
{
    use ApiTraits;

    public function __construct(AppSetting $model)
    {
        parent::__construct($model);
    }


}
