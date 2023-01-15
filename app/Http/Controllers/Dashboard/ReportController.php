<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\InstructorExport;
use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Interfaces\AreaRepositoryInterface;
use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\SpecializationRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    private $userRepoInterface, $specializationRepoInterface ,$areaRepoInterface, $cityRepoInterface;

    public function __construct(UserRepositoryInterface $userRepoInterface ,SpecializationRepositoryInterface $specializationRepoInterface ,AreaRepositoryInterface $areaRepoInterface, CityRepositoryInterface $cityRepoInterface)
    {
        $this->userRepoInterface = $userRepoInterface;
        $this->specializationRepoInterface = $specializationRepoInterface;
        $this->areaRepoInterface = $areaRepoInterface;
        $this->cityRepoInterface = $cityRepoInterface;


        $this->middleware(['permission:reports_index'])->only('user', 'instructor');
    }

    public function user(Request $request)
    {
        $users = $this->userRepoInterface->search($request,[User::TYPE_STUDENT]);
        if ($request->filled('export')) {
            if($request->export == 'excel'){
                $export = new UserExport($users->get());
                return Excel::download($export, 'users.xlsx');
            }
            if($request->export == 'pdf'){
                $users = $users->get();
                return view('web.pages.reports.partials.user_pdf', compact('users'));
            }
        } 
        $data=[
            'areas' => $this->areaRepoInterface->all(),
            'cities' => $this->cityRepoInterface->all(),
            'users' => $users->paginate(),
        ];
        return view('web.pages.reports.user', $data);
    }


    public function instructor(Request $request)
    {
        $instructors = $this->userRepoInterface->search($request,[User::TYPE_INSTRUCTOR]);
        if ($request->filled('export')) {
            if($request->export == 'excel'){
                $export = new InstructorExport($instructors->get());
                return Excel::download($export, 'users.xlsx');
            }
            if($request->export == 'pdf'){
                $instructors = $instructors->get();
                return view('web.pages.reports.partials.instructor_pdf', compact('instructors'));
            }
        } 

        $data=[
            'areas' => $this->areaRepoInterface->all(),
            'cities' => $this->cityRepoInterface->all(),
            'specializations' => $this->specializationRepoInterface->all(),
            'instructors' => $instructors->paginate(),
        ];
        return view('web.pages.reports.instructor', $data);
    }
}
