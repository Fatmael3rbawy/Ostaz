<?php 

  namespace App\Http\Controllers\Dashboard;

  use App\Http\Controllers\Controller;
  use Illuminate\Http\Request;
  use App\Interfaces\SpecializationRepositoryInterface;
  use App\Http\Requests\Web\Dashboard\specs\AddSpec;
use App\Interfaces\AttachmentAbleRepositoryInterface;
use App\Interfaces\AttachmentRepositoryInterface;
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\DB;

  class CategoryController extends Controller 
  {
    use HelperTrait;
    private $specializationRepo, $attachmentRepository, $attachmentAbleRepository ;

    public function __construct(SpecializationRepositoryInterface $specializationRepo, AttachmentRepositoryInterface $attachmentRepository, AttachmentAbleRepositoryInterface $attachmentAbleRepository )
    {
      $this->specializationRepo = $specializationRepo;
      $this->attachmentRepository = $attachmentRepository;
      $this->attachmentAbleRepository = $attachmentAbleRepository;

      $this->middleware(['permission:specializations_index'])->only('index');  
      $this->middleware(['permission:specializations_create'])->only('create', 'store');  
      $this->middleware(['permission:specializations_view'])->only('show'); 
      $this->middleware(['permission:specializations_edit'])->only('edit', 'update');
      $this->middleware(['permission:specializations_delete'])->only('destroy');  
      $this->middleware(['permission:specializations_block'])->only('block'); 
    }

    public function index()
    { 
      $data=[
        'list' => $this->specializationRepo->mainSpecializationWithPaginate(),
      ];
      return view('web.pages.spec.index', $data);
    }

    public function create()
    { 
      return view('web.pages.spec.add');
    }

    public function store(AddSpec $request)
    {
        $category = $this->specializationRepo->create($request->all());
        $image = $this->uploadImages($request->image , 'main_categories');
        $category_image = $this->attachmentRepository->create(['file' => $image]); 
        $this->attachmentAbleRepository->create([
            'attachment_id' => $category_image->id,
            'attachmentable_id' => $category->id,
            'attachmentable_type' => 'App\Models\Specialization',
            'key' => 'category',
        ]);
        return redirect()->route('categories.index')->with('success', 'Categories Added Succesfully');
    }

    public function edit($id, Request $request)
    {  
      $category = $this->specializationRepo->find($id, $request);
      return view('web.pages.spec.edit',compact('category'));
    }

    public function update( $id, Request $request)
    {
        $category = $this->specializationRepo->update($request->all(),$id, $request);
        $category = $this->specializationRepo->find($id, $request);
        $image = $this->uploadImages($request->image , 'main_categories');
        
        if ($request->hasFile('image')) {
          $image = $this->uploadImages($request->image , 'main_categories');
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
        return redirect()->route('categories.index')->with('success', 'Categories Updated Succesfully');
    }

    
    public function destroy($id,Request $request)
    {
      $this->specializationRepo->destroy($id, $request);
      return redirect()->route('categories.index')->with('success', 'Category Deleted Succesfully');
    }
    

    public function getSubByMainCategoryId(Request $request){
      
      $subCategory = DB::table("specializations")->where("parent_id",$request->id)->select('id', 'name AS value')->get();
      return $subCategory;
    }
  }
