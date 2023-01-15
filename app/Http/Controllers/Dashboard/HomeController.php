<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\SpecializationRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\City;
use App\Models\User;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    use HelperTrait;
    private $userRepository, $cityRepository, $specializationRepository;
  
    public function __construct(UserRepositoryInterface $userRepository, CityRepositoryInterface $cityRepository, SpecializationRepositoryInterface $specializationRepository)
    {
        $this->userRepository = $userRepository;
        $this->cityRepository = $cityRepository;
        $this->specializationRepository = $specializationRepository;
    }

    public function index(Request $request){

        // $tokens = ['caNJiniLT3mnGG92TFRw_Y:APA91bEeo70lrUbrIoa3VpwFJuoxrWvfKZ2IVqS-tutYyQdbBn7jzPNk_YrzAHcjpeR9_7i6w83UtuvyRjQFldIqLuMybMMmcLOx97x0x1aSJdcLf8VfGlagBgmnotaIXl03QMUjvQD4'];
        // $notification_message=[
        //     'title' => 'title',
        //     'body' => 'test',
        // ];
        // dd( $this->sendNotification($tokens, $notification_message));


        $request->merge(['type' => User::TYPE_EMPLOYEE]);
        $employees = $this->userRepository->BaseSearch($request)->count();

        $request['type'] = User::TYPE_INSTRUCTOR;
        $instructors = $this->userRepository->BaseSearch($request)->count();

        $request['type'] = User::TYPE_STUDENT;
        $users = $this->userRepository->BaseSearch($request)->count();


        $category  = $this->specializationRepository->has('users', '>', 0)->withCount('users')->orderByDesc("users_count");

        $category_labels = $category->take(5)->pluck('name')->toarray();
        $category_data = $category->take(5)->pluck('users_count')->toarray();


        $request['activeAreas'] = '';
        $cities = $this->cityRepository->BaseSearch($request)->get();

        $city_chart_instructors = [];
        $city_chart_users = [];
        $city_chart_areas = [];

        foreach($cities as $city){
            $user_count = 0;
            $instructor_count = 0;

            foreach($city->areas as $area){
                $instructor_count = $instructor_count + $area->users->where('type', User::TYPE_INSTRUCTOR)->count();
                $user_count = $user_count + $area->users->where('type', User::TYPE_STUDENT)->count();
            }
            $count = $city->areas->count();
            $city_chart_instructors [] = $instructor_count;
            $city_chart_users [] = $user_count;
            $city_chart_areas [] = $count;
        }

        $cities= $cities->pluck('name')->toarray();

        return view('web.pages.home.home',compact('employees','instructors', 'users','cities',
            'category_labels', 'category_data','city_chart_areas','city_chart_users','city_chart_instructors' ));
    }
}
