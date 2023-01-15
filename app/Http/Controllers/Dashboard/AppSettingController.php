<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Dashboard\AppSetting\editRequest;
use App\Interfaces\AppSettingRepositoryInterface;
use App\Interfaces\AttachmentAbleRepositoryInterface;
use App\Interfaces\AttachmentRepositoryInterface;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    use HelperTrait;
    private $appSettingRepository, $attachmentRepository, $attachmentableRepository; 
  
    public function __construct(AppSettingRepositoryInterface $appSettingRepository, AttachmentRepositoryInterface $attachmentRepository, AttachmentAbleRepositoryInterface $attachmentableRepository)
    {
        $this->appSettingRepository = $appSettingRepository;
        $this->attachmentRepository = $attachmentRepository;
        $this->attachmentableRepository = $attachmentableRepository;
        $this->middleware(['permission:app_settings_index'])->only('index');  
        $this->middleware(['permission:app_settings_edit'])->only('edit', 'update');

    }
    public function index(Request $request)
    {
        $data=[
            'list' => $this->appSettingRepository->find(1, $request),
        ];
        return view('web.pages.app_setting.index', $data);
    }

    public function edit($id, Request $request)
    {
        $data=[
            'list' => $this->appSettingRepository->find($id, $request),
        ];
        return view('web.pages.app_setting.edit', $data);
    }

    public function update($id, editRequest $request)
    {
        $this->appSettingRepository->update($request->all(), 1 , $request);
        $setting = $this->appSettingRepository->find($id, $request);
        if ($request->hasFile('image')) {
            $image = $this->uploadImages($request->image , 'app-setting');
            $oldImage = $setting->attachments()->where('key', 'app setting logo')->first();
            try {
              unlink(public_path().$oldImage->file);
                $this->attachmentRepository->destroy($oldImage->id, $request); 
            } catch (\Throwable $th) {
              //throw $th;
            }
            $new_image = $this->attachmentRepository->create(['file' => $image]); 
            $this->attachmentableRepository->create([
                'attachment_id' => $new_image->id,
                'attachmentable_id' => 1,
                'attachmentable_type' => 'App\Models\AppSetting',
                'key' => 'app setting logo',
            ]);
        }

        return redirect()->route('app-setting.index')->with('success', 'App Setting Updated Succesfully'); 

    }
}
