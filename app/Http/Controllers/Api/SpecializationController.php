<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\SpecializationRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\InstructorResource;
use App\Http\Resources\SpecializationResource;
use App\Http\Resources\SubSpecializationResource;
use App\Http\Resources\UserResource;
use App\Models\Specialization;
use App\Models\User;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
  use ApiTraits;

  private $specializationRepoInterface;
  function __construct(SpecializationRepositoryInterface $specializationRepoInterface)
  {
    $this->specializationRepoInterface = $specializationRepoInterface;
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $specializations = $this->specializationRepoInterface->mainSpecialization();
    return $this->responseJson(SpecializationResource::Collection($specializations));
  }
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function showSubSpecializations($id, Request $request)
  {
    $specialization = $this->specializationRepoInterface->find($id, $request);
    $sub_specializations = $this->specializationRepoInterface->subOfSpecificSpecialization($id);
    // return $sub_specializations;

    // if ($sub_specializations->isEmpty()) {
    //   $data = ['category' => 'this category is not found'];
    //   return $this->responseJsonFailedValidate($data);
    // }
    return $this->responseJson(SpecializationResource::collection($sub_specializations));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function showSubSpecializationsWithInstructors($id, Request $request)
  {

    $subSpecialization = $this->specializationRepoInterface->find($id, $request);
    if ($subSpecialization->parent_id != null)
      return $this->responseJson(UserResource::collection($subSpecialization->users()->where('type', User::TYPE_INSTRUCTOR)->get()));

  //  return $this->responseJsonFailedValidate('this sub category is not found');
  }
}
