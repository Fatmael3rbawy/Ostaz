<?php

namespace App\Interfaces;

use Illuminate\Http\Request ;

interface UserRepositoryInterface
{
    function search(Request $request);
    function login(Request $request);
    function checkUserType($email,$field_name, $values);
    function allInstrBySpec($id);
}