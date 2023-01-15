<?php 

namespace App\Http\Controllers\Dashboard;

use App\Exports\EmployeesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Dashboard\Employee\addRequest;
use App\Interfaces\AttachmentAbleRepositoryInterface;
use App\Interfaces\AttachmentRepositoryInterface;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use App\Models\Area;
use App\Models\City;
use App\Models\User;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class EmployeeController extends Controller 
{
  use HelperTrait;
  private $employeeRepository, $attachmentRepository, $roleRepository, $attachmentAbleRepository;

  public function __construct(EmployeeRepositoryInterface $employeeRepository, AttachmentRepositoryInterface $attachmentRepository, RoleRepositoryInterface $roleRepository, AttachmentAbleRepositoryInterface $attachmentAbleRepository)
  {
    $this->employeeRepository = $employeeRepository;
    $this->attachmentRepository = $attachmentRepository;
    $this->roleRepository = $roleRepository;
    $this->attachmentAbleRepository = $attachmentAbleRepository;
    $this->middleware(['permission:employees_index'])->only('index');  
    $this->middleware(['permission:employees_create'])->only('create', 'store');  
    $this->middleware(['permission:employees_view'])->only('show'); 
    $this->middleware(['permission:employees_edit'])->only('edit', 'update');
    $this->middleware(['permission:employees_delete'])->only('destroy');  
    $this->middleware(['permission:employees_block'])->only('block'); 
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $data=[
      'list' => $this->employeeRepository->allEmployee($request),
      'roles' => $this->roleRepository->all(),
    ];
    return view('web.pages.employee.index', $data);
  }

  public function exportExcel(Request $request){
    $export = new EmployeesExport($this->employeeRepository->allEmployee($request));
    return Excel::download($export, 'users.xlsx');
  }

  public function exportPdf(Request $request){
    $list = $this->employeeRepository->all($request)->where('type' , User::TYPE_EMPLOYEE);
    $pdf= PDF::loadView('web.pages.employee.partials.pdf', compact('list'));
    return $pdf->inline();
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $data=[
      'list' => $this->roleRepository->all(),
    ];

    $areas = Area::all();
    $cities = City::all();
    return view('web.pages.employee.add',$data,compact('cities','areas'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(addRequest $request)
  {
    $request->merge(['password' => 'password', 'type' => User::TYPE_EMPLOYEE]);
    $employee = $this->employeeRepository->create($request->all());
    $this->employeeRepository->assignRole($employee, $request->role);
    if ($request->hasFile('image')) {
      $image = $this->uploadImages($request->image , 'employee/avatars');
    }else{
      $image = 'assets/img/logo.png';
    }
    $avtar = $this->attachmentRepository->create(['file' => $image]); 
    $this->attachmentAbleRepository->create([
        'attachment_id' => $avtar->id,
        'attachmentable_id' => $employee->id,
        'attachmentable_type' => 'App\Models\User',
        'key' => 'avatar',
    ]);
    return redirect()->route('employees.index')->with('success', 'Employee Added Succesfully'); 
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
  public function edit($id, Request $request)
  {   
    $data=[
      'list' => $this->roleRepository->all(),
      'employee' => $this->employeeRepository->find($id, $request),
    ];
    return view('web.pages.employee.edit',$data);
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id, Request $request)
  {

    $employee = $this->employeeRepository->update($request->all(),$id, $request);
    $this->employeeRepository->assignRole($employee, $request->role);
    if ($request->hasFile('image')) {
      $image = $this->uploadImages($request->image , 'employee/avatars');
      $oldImage = $employee->attachments()->where('key', 'avatar')->first();
      try {
        unlink(public_path().$oldImage->file);
      } catch (\Throwable $th) {
        //throw $th;
      }
      $this->attachmentRepository->destroy($oldImage->id, $request); 
      $avtar = $this->attachmentRepository->create(['file' => $image]); 
      $this->attachmentAbleRepository->create([
          'attachment_id' => $avtar->id,
          'attachmentable_id' => $employee->id,
          'attachmentable_type' => 'App\Models\User',
          'key' => 'avatar',
      ]);
    }

     
    return redirect()->route('employees.index')->with('success', 'Employee Updated Succesfully'); 

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id, Request $request)
  {

    $this->employeeRepository->destroy($id, $request);
    return redirect()->route('employees.index')->with('success', 'Employee Deleted Succesfully');
  }


  public function block($id, Request $request)
  {
    $this->employeeRepository->update(['status' => 0],$id, $request);
    return redirect()->route('employees.index')->with('success', 'Employee Blocked Succesfully');
  }
  
}

?>