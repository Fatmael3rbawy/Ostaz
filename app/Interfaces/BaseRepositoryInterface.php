<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Client\Request;

interface BaseRepositoryInterface
{
    public function create(array $attributes): Model;
    public function update(array $attributes, $id, $request);
    public function find($id, Request $request): ?Model;
    public function all(): Collection;
    public function allWithPaginate($number = 15);
    public function allWithPaginateExcept($id, $number = 15);
    public function groupBy($key);
    public function destroy($id, $request);
    public function findBy($request , $field_name, $field);
    public function BaseSearch(Request $request);
}