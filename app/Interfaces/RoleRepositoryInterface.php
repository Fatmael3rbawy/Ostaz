<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Client\Request;

interface RoleRepositoryInterface
{
    public function givePermission(array $attributes , $model);
    public function destroyWithCheck($id, $request);
    public function block($id, $request);
    public function allSearchAble($request ,$filters = ['pagination' => 10,'order' => 'desc']);
    
}