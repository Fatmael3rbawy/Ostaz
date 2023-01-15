<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Dashboard\User\StoreUserRequest;
use App\Interfaces\AreaRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\SpecializationRepositoryInterface;

class UserController extends Controller
{
  private $userRepoInterface, $specializationRepoInterface ,$cityRepoInterface ,$areaRepoInterface;
  
  public function __construct(UserRepositoryInterface $userRepoInterface, CityRepositoryInterface $cityRepoInterface ,SpecializationRepositoryInterface $specializationRepoInterface ,AreaRepositoryInterface $areaRepoInterface )
  {
    $this->userRepoInterface = $userRepoInterface;
    $this->cityRepoInterface = $cityRepoInterface;
    $this->specializationRepoInterface = $specializationRepoInterface;
    $this->areaRepoInterface = $areaRepoInterface;

  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    // dd($request->feature);
    $cities = $this->cityRepoInterface->all();
    $areas = $this->areaRepoInterface->all();
    $specializations =$this->specializationRepoInterface->all();
    $users = $this->userRepoInterface->search($request)->paginate();
      // dd($users);
    if ($users->isEmpty())
      return view('web.pages.user.index',compact('users','specializations' ,'cities' ,'areas'))->with('message', 'There are not users');
    else
      return view('web.pages.user.index', compact('users','specializations' ,'cities' ,'areas'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('web.pages.user.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id ,Request $request)
  {
    $this->userRepoInterface->destroy($id ,$request);
    return back()->with('success', 'User deleted successfully');
  }

  
  public function block($id, Request $request)
  {
    $this->userRepoInterface->update(['status' => 0],$id, $request);
    return back()->with('success', 'User Blocked Succesfully');
  }
}
