<?php

namespace App\Repositories;

use App\Interfaces\NotificationRepositoryInterface;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{

    public function __construct(Notification $model)
    {
        parent::__construct($model);
    }

    

}