<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model 
{

    protected $table = 'attachments';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'file',
    ];

    public function users()
    {
        return $this->morphedByMany(User::class, 'attachmentable');
    }

    public function specializations()
    {
        return $this->morphedByMany(Specialization::class, 'attachmentable');
    }

    protected $appends = ['image_path'];
    
    public function getImagePathAttribute(){
        return asset('uploads/specs/'.$this->file);
    }
}