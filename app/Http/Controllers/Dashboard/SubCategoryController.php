<?php 

  namespace App\Http\Controllers\Dashboard;

  use App\Http\Controllers\Controller;
  use Illuminate\Http\Request;
  use App\Interfaces\SpecializationRepositoryInterface;
  use App\Http\Requests\Web\Dashboard\SubCategory\Add;
  use App\Interfaces\AttachmentAbleRepositoryInterface;
  use App\Interfaces\AttachmentRepositoryInterface;
  use App\Traits\HelperTrait;

  class SubCategoryController extends Controller 
  {
    use HelperTrait;
    private $specializationRepo, $attachmentRepository, $attachmentAbleRepository ;

    public function __construct(SpecializationRepositoryInterface $specializationRepo, AttachmentRepositoryInterface $attachmentRepository, AttachmentAbleRepositoryInterface $attachmentAbleRepository )
    {
      $this->specializationRepo = $specializationRepo;
      $this->attachmentRepository = $attachmentRepository;
      $this->attachmentAbleRepository = $attachmentAbleRepository;

      $this->middleware(['permission:sub_specializations_index'])->only('index');  
      $this->middleware(['permission:sub_specializations_create'])->only('create', 'store');  
      $this->middleware(['permission:sub_specializations_view'])->only('show'); 
      $this->middleware(['permission:sub_specializations_edit'])->only('edit', 'update');
      $this->middleware(['permission:sub_specializations_delete'])->only('destroy');  
      $this->middleware(['permission:sub_specializations_block'])->only('block'); 
    }

    public function index()
    { 
      $data=[
        'list' => $this->specializationRepo->subSpecializationWithPaginate(),
      ];
      return view('web.pages.sub_category.index', $data);
    }

    public function create()
    { 
      $categories = $this->specializationRepo->mainSpecialization();
      return view('web.pages.sub_category.add', compact('categories'));
    }

    public function store(Add $request)
    {
        $category = $this->specializationRepo->create($request->all());
        $image = $this->uploadImages($request->image , 'sub_categories');
        $category_image = $this->attachmentRepository->create(['file' => $image]); 
        $this->attachmentAbleRepository->create([
            'attachment_id' => $category_image->id,
            'attachmentable_id' => $category->id,
            'attachmentable_type' => 'App\Models\Specialization',
            'key' => 'category',
        ]);
        return redirect()->route('sub-categories.index')->with('success', 'Sub Categories Added Succesfully');
    }

    public function edit($id, Request $request)
    {  
      $category = $this->specializationRepo->find($id, $request);
      $categories = $this->specializationRepo->mainSpecialization();
      return view('web.pages.sub_category.edit',compact('category','categories'));
    }

    public function update( $id, Request $request)
    {
        $category = $this->specializationRepo->update($request->all(),$id, $request);
        $category = $this->specializationRepo->find($id, $request);

        if ($request->hasFile('image')) {
          $image = $this->uploadImages($request->image , 'sub_categories');
          $oldImage = $category->attachments()->where('key', 'category')->first();
          try {
            unlink(public_path().$oldImage->file);
          } catch (\Throwable $th) {
            //throw $th;
          }
          if($oldImage){
            $this->attachmentRepository->destroy($oldImage->id, $request); 
          }
          $category_image = $this->attachmentRepository->create(['file' => $image]); 
          $this->attachmentAbleRepository->create([
            'attachment_id' => $category_image->id,
            'attachmentable_id' => $category->id,
            'attachmentable_type' => 'App\Models\Specialization',
            'key' => 'category',
        ]);
        }
        return redirect()->route('sub-categories.index')->with('success', 'Sub Categories Updated Succesfully');
    }

    
    public function destroy($id,Request $request)
    {
      $this->specializationRepo->destroy($id, $request);
      return redirect()->route('sub-categories.index')->with('success', 'Sub Category Deleted Succesfully');
    }
    
  }
  // {
    
    // private $specializationRepo;

    // public function __construct(SpecializationRepositoryInterface $specializationRepo )
    // {
    //   $this->specializationRepo = $specializationRepo;
    // }

    // public function index()
    // { 
    //   $data=[
    //     'list' => $this->specializationRepo->allWithPaginate(),
    //   ];
    //   return view('web.pages.spec.index', $data);
    // }

    

    // public function allSubSpecs(){
    //   $specs = $this->specializationRepo->subSpecialization()->load('attachments');
    //   //get all main specialization for DDL
    //   $allMainSpecs = $this->specializationRepo->mainSpecialization();
    //   return view('web.pages.spec.index',compact('specs','allMainSpecs'));
    // }
    
    // public function subSpecificSpec($id){
    //   $specs = $this->specializationRepo->subSpecificSpecialization($id);
    //   if($specs->isEmpty()){
    //     return redirect()->route('specs.index')->with('error', 'This Main Specialization don\'t have any Sub Specializations');
    //   }
    //   //get all main specialization for DDL
    //   $allMainSpecs = $this->specializationRepo->mainSpecialization();

    //   return view('web.pages.spec.index',compact('specs','allMainSpecs'));
    // }
    // public function changeStatus(Request $request){
    //   $spec = Specialization::find($request->id);
    //   $spec->status = $request->status;
    //   $spec->save();
    //   return response()->json(['success'=>'status changed successfully']);
    // }
    // public function store(AddSpec $request)
    // {
    //     $spec = $this->specializationRepo->store($request);
    //     if($spec){
    //       return redirect()->route('specs.index')->with('success', 'Specialization Cretated Succesfully');
    //     }else{
    //       return redirect()->route('roles.index')->with('error', 'Specialization not Created');
    //     }

    // }
    
    // //show instructors of Specific specialization
    // public function show($id,Request $request)
    // {
    //   $spec = $this->instructorRepo->allInstrBySpec($id);
    //   $users = $this->instructorRepo->search($request);
    //   return view('web.pages.spec.show',compact('spec'));
    // }

    // public function edit($id)
    // {
    //   $spec = $this->specializationRepo->edit($id);
    //   return view('web.pages.spec.edit',compact('spec'));
    // }

    // public function update(UpdateSpec $request,$id)
    // {  
    //     // $newSpecData = $request->except('file');
    //     $spec = $this->specializationRepo->updatee($request , $id);
    //     if($spec){
    //       return redirect()->route('specs.index')->with('success', 'Specialization Updated Succesfully');
    //     }else{
    //       return redirect()->route('roles.index')->with('error', 'Specialization not Updated');
    //     }
    // } 

    // public function destroy($id,Request $request)
    // {
    //   // $this->middleware(['permission:roles_block']); 
    //   $spec = $this->specializationRepo->delete($id,$request);
    //   if($spec){
    //     return redirect()->route('specs.index')->with('success', 'Specialization Deleted Succesfully');
    //   }else{
    //     return redirect()->route('specs.index')->with('error', 'Specialization not Deleted');
    //   }
    // }
    
  // }
