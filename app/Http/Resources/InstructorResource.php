<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstructorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return  [
            'name' => $this->name,
            'email' => $this->email,
            'area_id' => $this->area_id,
            'whatsapp' => $this->whatsapp,
            'phone' => $this->phone,
            'facebook' => $this->facebook,
            'description' => $this->description,
        ];
    }
}
