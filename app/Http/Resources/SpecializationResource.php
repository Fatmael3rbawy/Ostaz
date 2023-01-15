<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SpecializationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user_id = null;
        if (auth()->user())
            $user_id = auth()->user()->id;
        return [
            'id' => $this->id,
            'name' => $this->name,
            $this->mergeWhen(isset($user_id),[
                'subCategory' => $this->subSpecializations()->whereHas(
                    'users',
                    function ($q) use ($user_id) {
                        $q->where('user_id', $user_id);
                    }
                )->get(),
            ]),
            'image' => isset($this->attachments()->first()->file) ? env('APP_URL') . $this->attachments()->first()->file : null,
        ];
    }
}
