<?php

namespace App\Http\Resources;

use App\Models\Specialization;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'duration' => $this->duration,
            'start_date' => $this->start_date,
            'image' => isset($this->specialization->attachments()->where('key', 'category')->first()->file) ? env('APP_URL').$this->specialization->attachments()->where('key', 'category')->first()->file : null,
            'category_name' => isset($this->specialization->name)? $this->specialization->name:'',
        ];
    }
}
