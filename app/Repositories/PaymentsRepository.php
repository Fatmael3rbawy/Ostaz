<?php

namespace App\Repositories;

use App\Interfaces\PaymentsRepositoryInterface;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsRepository extends BaseRepository implements PaymentsRepositoryInterface
{

    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }

    public function listPayments($request)
    {
       return $this->model->where(['course_id' => $request->course_id, 'student_id' => $request->student_id])->get();
    }
    
}
