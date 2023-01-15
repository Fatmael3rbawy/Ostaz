<?php

namespace App\Http\Resources;

use App\Interfaces\CityRepositoryInterface;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $type='Student';
        if($this->type == (User::TYPE_PARENT)){
            $type= 'Parent';
        }elseif($this->type == (User::TYPE_INSTRUCTOR)){
            $type= 'Instructor';
        }

        $is_favourite = false;
        if($request->user()){
            $is_favourite = Wishlist::where(['user_id' => $request->user()->id, 'favourite_id'=> $this->id ])->first() ? true : false ;
        }


        $request->merge([
            'cityWithAreaByUser' => $request->user()->id,
            'activeAreaCityByUser' => $request->user()->id,
        ]);
        $cities = app(CityRepositoryInterface::class)->BaseSearch($request)->get();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'whatsapp' => isset($this->whatsapp) ? $this->whatsapp : '' ,
            'phone' => isset($this->phone) ? $this->phone : '',
            'type' => $type,
            'description' => isset($this->description) ? $this->description : '',
            'views' => str($this->views),
            'image' => isset($this->attachments()->where('key', 'avatar')->first()->file) ? env('APP_URL').$this->attachments()->where('key', 'avatar')->first()->file : null,
            'is_favourite' => $is_favourite,
            'locations' => $this->areas()->first() ? true : false,
            $this->mergeWhen(isset($this->api_token),[
                'token' => $this->api_token, 
            ]),
            $this->mergeWhen(($type == 'Instructor'), [
                'teaching_method' => MethodResource::collection($this->methods),

                'coverd_area' => AreaCityResource::collection($cities),

                'categories' => SpecializationResource::collection($this->specializations->where('parent_id', null)),
                'facebook' => isset($this->facebook) ? $this->facebook : '',
                'courses' => CourseResource::collection($this->instructorCourses),
                
            ]),
        ];
    }
}
