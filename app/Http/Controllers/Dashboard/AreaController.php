<?php 

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Dashboard\Area\AddRequest;
use App\Interfaces\AreaRepositoryInterface;
use App\Interfaces\CityRepositoryInterface;
use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller 
{

    public  $areaRepository, $cityRepoInterface;
    public function __construct(AreaRepositoryInterface $areaRepository, CityRepositoryInterface $cityRepoInterface)
    {
      $this->areaRepository = $areaRepository;
      $this->cityRepoInterface = $cityRepoInterface;
      $this->middleware(['permission:areas_index'])->only('index');  
      $this->middleware(['permission:areas_create'])->only('create', 'store');  
      $this->middleware(['permission:areas_view'])->only('show'); 
      $this->middleware(['permission:areas_edit'])->only('edit', 'update');
      $this->middleware(['permission:areas_delete'])->only('destroy');  
      $this->middleware(['permission:areas_block'])->only('block'); 
    }  

    public function index(Request $request)
    {
      $areas= $this->areaRepository->BaseSearch($request)->paginate();
      $cities =$this->cityRepoInterface->all();
      return view('web.pages.area.index',compact('areas', 'cities'));  
    }


    public function create()
    {
      $cities =$this->cityRepoInterface->allWithPaginate();

      return view('web.pages.area.add',compact('cities')); 
    }

    public function store(AddRequest $request)
    {
      $this->areaRepository->create($request->all());
      return redirect()->route('area.index')->with('success', 'Area Added Succesfully'); 

    }

    public function show($id)
    {
      
    }

    public function edit($id,Request $request )
    {
      $cities =$this->cityRepoInterface->all();
      $area =$this->areaRepository->find($id, $request);
      return view('web.pages.area.edit',compact('cities', 'area'));
    }

    public function update($id,AddRequest $request)
    {
      $this->areaRepository->update($request->all(),$id, $request);
      return redirect()->route('area.index')->with('success', 'Area Updated Succesfully'); 

    }

    public function destroy($id, Request $request)
    {
      $this->areaRepository->destroy($id, $request);
      return redirect()->route('area.index')->with('success', 'Area Deleted Succesfully'); 

    }

    public function getAreabyCityId(Request $request){
      $areas = DB::table("areas")->where("city_id",$request->id)->select('id', 'area AS value')->get();
      return $areas;
    }

}

?>