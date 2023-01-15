<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExport implements FromCollection, WithHeadings, WithMapping
{
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function map($users): array
    {
        return [
            $users->name,
            $users->email,
            $users->cityList($users->areas),
            $users->areaList($users->areas),
        ];
    }

    public function collection()
    {
        return $this->users;
    }

    public function headings() :array
    {
        return ["Name", "Email", "Cities", "Areas"];
    }
}
