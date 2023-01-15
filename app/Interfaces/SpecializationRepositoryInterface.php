<?php

namespace App\Interfaces;


interface SpecializationRepositoryInterface
{
    public function mainSpecialization();
    public function subOfSpecificSpecialization($id);
    public function subSpecializationWithPaginate();
}