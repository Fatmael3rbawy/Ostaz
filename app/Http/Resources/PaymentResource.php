<?php

namespace App\Http\Resources;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    { 
        $status='unpaid';
        if($this->status == (Payment::STATUS_REFUND)){
            $status= 'refund';
        }elseif($this->status == (Payment::STATUS_PAID)){
            $status= 'paid';
        }elseif($this->status == (Payment::STATUS_DUE)){
            $status= 'due';
        }

        return [
            'id' => $this->id,
            'student_name' => $this->student->name,  
            'price' => $this->course->price,
            'due_date' => $this->date,
            //Carbon::parse($this->course->start_date)->addMonth($this->date)->format('y-m-d'),
            'status' => $status,
        ];
    }
}
