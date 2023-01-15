<?php

namespace App\Repositories;

use App\Interfaces\AttachmentRepositoryInterface;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Attachment;
use App\Models\User;
use App\Repositories\BaseRepository;


class AttachmentRepository extends BaseRepository implements AttachmentRepositoryInterface
{
    public function __construct(Attachment $model)
    {
        parent::__construct($model);
    }

}