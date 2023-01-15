<?php

namespace App\Interfaces;

interface WishlistRepositoryInterface
{
    function check($user_id , $favourite_id );
    
}