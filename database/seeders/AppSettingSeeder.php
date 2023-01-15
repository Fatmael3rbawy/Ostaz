<?php

namespace Database\Seeders;

use App\Models\AppSetting;
use App\Models\AttachmenAbles;
use App\Models\Attachment;
use Illuminate\Database\Seeder;

class AppSettingSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        $setting = AppSetting::create([
            'welcome_message' => 'welcome to ostaz app',
        ]);

        $logo = Attachment::create(['file' =>  'assets/img/logo.png']); 
        AttachmenAbles::create([
            'attachment_id' => $logo->id,
            'attachmentable_id' => $setting->id,
            'attachmentable_type' => 'App\Models\AppSetting',
            'key' => 'app setting logo',
        ]);
    }
}