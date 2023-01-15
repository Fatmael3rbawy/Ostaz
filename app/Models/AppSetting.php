<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'welcome_message',
    ];

    public function attachments()
    {
        return $this->morphToMany(Attachment::class, 'attachmentable');
    }
}
