<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface AreaRepositoryInterface
{
    public function addArea(Request $request);

    public function updateArea(Request $request,$id);

    function findBy($request , $field_name, $field);

}