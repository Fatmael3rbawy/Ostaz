<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\Area;
use App\Models\User;
use App\Traits\ApiTraits;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\Specialization;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    use ApiTraits;

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function search(Request $request, $types =[User::TYPE_INSTRUCTOR, User::TYPE_PARENT, User::TYPE_STUDENT])
    {

        return $this->model->where('status', 1)->whereIn('type',$types)
            ->where(function ($query) use ($request) {

                if ($request->filled('text')) {
                    $query->name($request->text);
                 } 

                 if ($request->type) {
                    $query->type($request->type);
                 } 

                 if ($request->specialization) {
                    $query->specialization($request->specialization);
                }

                if($request->city){
                    $areas = Area::where('city_id',$request->city)->pluck('id')->toArray();
                    $query->whereHas('areas', function (Builder $query) use ($areas){
                        $query->whereIn('area_id', $areas);
                    });
                }

                if ($request->area) {
                    $query->area($request->area);
                }

                if ($request->feature) {
                    $query->feature($request->feature);
                 }
            })
             ->orderBy('id');
    }
    
    public function login(Request $request)
    {
       return Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        
    }

    public function checkUserType($email,$field_name, $values){
        return $this->model->where('email', $email)->whereIn($field_name, $values)->first();
    }

    public function checkUserToken($token){
        return PersonalAccessToken::findToken($token);
    }

    public function checkPassword($new_password, $old_password ){
        return Hash::check($new_password, $old_password);
    }

    public function addArea($user, array $areas_id ){
        $user->areas()->sync($areas_id);
        return true;
    }

    public function destroyArea($user, $area_id ){
        if(!($user->areas()->find($area_id))){
            return abort($this->responseJsonFailed('This area not belong to this user', 404));
        }
        return $user->areas()->detach($area_id);
    }

    public function allInstrBySpec($id)
    {
        //get specialization with users with areas with city
        $specialization = Specialization::where('id',$id)->with('users.areas.city')->get();
        return $specialization;   
    }
    
    public function MostViewd($number = 5){
        return $this->model->where(['type' => User::TYPE_INSTRUCTOR, ['views' , '!=' , 0]])->take($number)->orderBy('views', 'DESC')->get();
    }

    public function PaidInstructor(){
        return $this->model->where(['type' => User::TYPE_INSTRUCTOR, 'active' => 1])->get();
    }

    public function findBy($request , $field_name, $field){
        $model = $this->model->where($field_name, $field)->first();
        return $model;
    }
}
