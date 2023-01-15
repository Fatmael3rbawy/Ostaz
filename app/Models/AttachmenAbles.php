<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttachmenAbles extends Model 
{

    protected $table = 'attachmentables';
    public $timestamps = true;

    protected $fillable = [
        'attachment_id',
        'attachmentable_id',
        'attachmentable_type',
        'key',
    ];


}