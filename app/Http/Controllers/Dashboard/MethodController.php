<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Dashboard\Method\AddRequest;
use App\Interfaces\MethodRepositoryInterface;
use Illuminate\Http\Request;

class MethodController extends Controller
{
    private $methodRepository; 

    public function __construct(MethodRepositoryInterface $methodRepository)
    {
        $this->methodRepository = $methodRepository;
        $this->middleware(['permission:methods_index'])->only('index');  
        $this->middleware(['permission:methods_create'])->only('create', 'store');  
        $this->middleware(['permission:methods_view'])->only('show'); 
        $this->middleware(['permission:methods_edit'])->only('edit', 'update');
        $this->middleware(['permission:methods_delete'])->only('destroy');  
        $this->middleware(['permission:methods_block'])->only('block'); 
    }

    public function index(Request $request)
    {
        $methods = $this->methodRepository->BaseSearch($request)->paginate();
        return view('web.pages.method.index', compact('methods'));
        
    }

    public function create()
    {
        return view('web.pages.method.add');
    }
        
    public function store(AddRequest $request)
    {
        $this->methodRepository->create($request->all()); 
        return redirect()->route('method.index')->with('success', 'Method Added Succesfully');         
    }

    public function show($id)
    {
        
    }

    public function edit($id, Request $request)
    {
        $method = $this->methodRepository->find($id, $request);
        return view('web.pages.method.edit', compact('method'));  
    }

    public function update($id, AddRequest $request)
    {
        $this->methodRepository->update($request->all(), $id, $request); 
        return redirect()->route('method.index')->with('success', 'Method Updated Succesfully'); 
    }

    public function destroy($id, Request $request)
    {
        $this->methodRepository->destroy($id, $request);
        return redirect()->route('method.index')->with('success', 'Method Deleted Succesfully');      
    }
}
