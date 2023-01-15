<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Dashboard\Instructor\UpdateRequest;
use App\Http\Requests\Web\Dashboard\Instructor\UpgradeRequest;
use App\Interfaces\AreaRepositoryInterface;
use App\Interfaces\AttachmentAbleRepositoryInterface;
use App\Interfaces\AttachmentRepositoryInterface;
use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\MethodRepositoryInterface;
use App\Interfaces\SpecializationRepositoryInterface;
use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Traits\HelperTrait;

class InstructorController extends Controller
{
  use HelperTrait;
  private $userRepoInterface, $specializationRepoInterface, $cityRepoInterface, $areaRepoInterface, $methdoRepoInterface,$attachmentRepository, $attachmentAbleRepository;

  public function __construct(UserRepositoryInterface $userRepoInterface, SpecializationRepositoryInterface $specializationRepoInterface, CityRepositoryInterface $cityRepoInterface, AreaRepositoryInterface $areaRepoInterface , MethodRepositoryInterface $methdoRepoInterface ,AttachmentRepositoryInterface $attachmentRepository,AttachmentAbleRepositoryInterface $attachmentAbleRepository)
  {
    $this->userRepoInterface = $userRepoInterface;
    $this->specializationRepoInterface = $specializationRepoInterface;
    $this->cityRepoInterface = $cityRepoInterface;
    $this->areaRepoInterface = $areaRepoInterface;
    $this->methdoRepoInterface = $methdoRepoInterface;
    $this->attachmentAbleRepository = $attachmentAbleRepository;
    $this->attachmentRepository = $attachmentRepository;
    $this->middleware(['permission:instructor_upgrade'])->only('upgrade');  
    $this->middleware(['permission:instructor_create'])->only('create', 'store');  
    $this->middleware(['permission:instructor_view'])->only('show'); 
    $this->middleware(['permission:instructor_edit'])->only('edit', 'update');
    $this->middleware(['permission:instructor_delete'])->only('destroy');  
    

  }


  public function show($id, Request $request)
  {
    $instructor = $this->userRepoInterface->find($id, $request);
    return view('web.pages.instructor.show', compact('instructor'));
  }

  public function upgrade($id, Request $request)
  {
    $user = $this->userRepoInterface->find($id, $request);
    $cities = $this->cityRepoInterface->all();
    $areas = $this->areaRepoInterface->all();
    $methods =  $this->methdoRepoInterface->all();
    $specializations = $this->specializationRepoInterface->mainSpecialization();
    $subspecializations = $this->specializationRepoInterface->subSpecialization();

    return view('web.pages.instructor.upgrade', compact('user', 'methods','specializations', 'subspecializations', 'cities', 'areas'));
  }

  public function handleUpgrade(UpgradeRequest $request, $id)
  {
    $user = $this->userRepoInterface->find($id, $request);

    $request->merge([
      'type'    => User::TYPE_INSTRUCTOR,
    ]);
    if ($request->hasFile('image')) {
      $image = $this->uploadImages($request->image , 'instructor/avatars');
      $oldImage = $user->attachments()->where('key', 'avatar')->first();
      try {
        unlink(public_path().$oldImage->file);
      } catch (\Throwable $th) {
        //throw $th;
      }
      $this->attachmentRepository->destroy($oldImage->id, $request); 
      $avtar = $this->attachmentRepository->create(['file' => $image]); 
      $this->attachmentAbleRepository->create([
          'attachment_id' => $avtar->id,
          'attachmentable_id' => $user->id,
          'attachmentable_type' => 'App\Models\User',
          'key' => 'avatar',
      ]);
    }
    $user = $this->userRepoInterface->update( $request->all(), $id, $request);
    // dd($user);
    $user = $this->userRepoInterface->find($id, $request);

    $user->areas()->sync($request->areas);
    $user->specializations()->sync($request->subspecializations);
    $user->methods()->sync($request->methods);
    return redirect(route('users.index'))->with('success', 'User upgeaded to instructor successfully');
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $cities = $this->cityRepoInterface->all();
    $areas = $this->areaRepoInterface->all();
    $methods =  $this->methdoRepoInterface->all();
    $specializations = $this->specializationRepoInterface->mainSpecialization();
    $subspecializations = $this->specializationRepoInterface->subSpecialization();
    // dd($subspecializations);

    return view('web.pages.instructor.create', compact('specializations','methods', 'subspecializations', 'cities', 'areas'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(UpgradeRequest $request)
  {

    $request->merge([
      'password' => 'password',
      'type'    => User::TYPE_INSTRUCTOR,
    ]);

    $user = $this->userRepoInterface->create($request->all());

    if ($request->hasFile('image')) {
      $image = $this->uploadImages($request->image , 'instructor/avatars');
    }else{
      $image = 'assets/img/logo.png';
    }
    $avtar = $this->attachmentRepository->create(['file' => $image]); 
    $this->attachmentAbleRepository->create([
        'attachment_id' => $avtar->id,
        'attachmentable_id' => $user->id,
        'attachmentable_type' => 'App\Models\User',
        'key' => 'avatar',
    ]);

    $user->areas()->attach($request->areas);
    $user->specializations()->attach($request->subspecializations);
    $user->methods()->attach($request->methods);

    return redirect(route('users.index') . '?type=3&view=instructor')->with('success', 'Instructor created successfully');
  }

  public function edit($id, Request $request)
  {
    $user = $this->userRepoInterface->find($id, $request);
    $cities = $this->cityRepoInterface->all();
    $areas = $this->areaRepoInterface->all();
    $methods =  $this->methdoRepoInterface->all();
    $specializations = $this->specializationRepoInterface->mainSpecialization();
    $subspecializations = $this->specializationRepoInterface->subSpecialization();
    return view('web.pages.instructor.edit', compact('user', 'cities', 'areas', 'specializations', 'subspecializations','methods'));
  }

  public function update($id, UpgradeRequest $request)
  {
    
    $user = $this->userRepoInterface->find($id, $request);

    if ($request->hasFile('image')) {
      $image = $this->uploadImages($request->image , 'instructor/avatars');
      $oldImage = $user->attachments()->where('key', 'avatar')->first();
      try {
        unlink(public_path().$oldImage->file);
      } catch (\Throwable $th) {
        //throw $th;
      }
      $this->attachmentRepository->destroy($oldImage->id, $request); 
      $avtar = $this->attachmentRepository->create(['file' => $image]); 
      $this->attachmentAbleRepository->create([
          'attachment_id' => $avtar->id,
          'attachmentable_id' => $user->id,
          'attachmentable_type' => 'App\Models\User',
          'key' => 'avatar',
      ]);
    }
    $inst = $this->userRepoInterface->update( $request->all(), $id, $request);
    // dd($user);
   // $user = $this->userRepoInterface->find($id, $request);

    $user->areas()->sync($request->areas);
    $user->specializations()->sync($request->subspecializations);
    $user->methods()->sync($request->methods);
    return redirect(route('users.index'))->with('success', 'User updated to instructor successfully');
  }

  public function destroy($id ,Request $request)
  {
      $this->userRepoInterface->destroy($id, $request);
      return back()->with('success', 'Instructor Deleted Succesfully');
  }
}
