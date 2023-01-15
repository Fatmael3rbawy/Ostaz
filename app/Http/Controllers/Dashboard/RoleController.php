<?php 

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Dashboard\Role\AddRequest;
use App\Http\Requests\Web\Dashboard\Role\editRequest;
use App\Interfaces\PermissionRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;

class RoleController extends Controller 
{
  use ApiTraits;
  private $roleRepository , $permissionRepository;
  
  public function __construct(RoleRepositoryInterface $roleRepository, PermissionRepositoryInterface $permissionRepository)
  {
    $this->roleRepository = $roleRepository;
    $this->permissionRepository = $permissionRepository;
    $this->middleware(['permission:roles_index'])->only('index');  
    $this->middleware(['permission:roles_create'])->only('create', 'store');  
    $this->middleware(['permission:roles_view'])->only('show'); 
    $this->middleware(['permission:roles_edit'])->only('edit', 'update');
    $this->middleware(['permission:roles_delete'])->only('destroy');  
    $this->middleware(['permission:roles_block'])->only('block'); 
  }

  public function index(Request $request)
  { 
    $data=[
      'list' => $this->roleRepository->allSearchAble($request ,$filters = ['pagination' => 20,'order' => 'asc']),
    ];
    return view('web.pages.roles.index', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  { 
    $data=[
      'list' => $this->permissionRepository->groupBy('key'),
    ];
    return view('web.pages.roles.add', $data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(AddRequest $request)
  {
    $role = $this->roleRepository->create([
      'name' => $request->name
    ]);
    $this->roleRepository->givePermission($request->except(['name', '_token']), $role);
    app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    return redirect()->route('roles.index')->with('success', 'Role Added Succesfully'); 
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id,Request $request)
  {
    $data=[
      'list' => $this->permissionRepository->groupBy('key'),
      'role' => $this->roleRepository->find($id, $request),
    ];
    return view('web.pages.roles.view', $data);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id, Request $request)
  {
    $role = $this->roleRepository->find($id, $request);
    if ($role->id == 1) {
      abort(403, 'Access denied');
    }
    $data=[
      'list' => $this->permissionRepository->groupBy('key'),
      'role' => $role,
    ];
    return view('web.pages.roles.edit', $data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id, editRequest $request)
  { 
    $role = $this->roleRepository->find($id, $request);
    if ($role->id == 1) {
      abort(403);
    }
    $role = $this->roleRepository->find($id, $request);
    $this->roleRepository->givePermission($request->except(['name', '_token', '_method']), $role);
    app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    return redirect()->route('roles.index')->with('success', 'Role Updated Succesfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id, Request $request)
  { 
    $this->roleRepository->destroyWithCheck($id, $request);
    app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    return redirect()->route('roles.index')->with('success', 'Role Deleted Succesfully');
  }

  public function block($id, Request $request)
  { 
    $this->roleRepository->block($id, $request);
    return redirect()->route('roles.index')->with('success', 'Role Blocked Succesfully');
  }
  
}

?>
