<?php

namespace App\Repositories;

use App\Interfaces\AttachmentAbleRepositoryInterface;
use App\Models\AttachmenAbles;
use App\Repositories\BaseRepository;


class AttachmentAbleRepository extends BaseRepository implements AttachmentAbleRepositoryInterface
{
    public function __construct(AttachmenAbles $model)
    {
        parent::__construct($model);
    }

}