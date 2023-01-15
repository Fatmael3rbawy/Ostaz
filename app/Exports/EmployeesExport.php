<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $employees;

    public function __construct($employees)
    {
        $this->employees = $employees;
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function map($employees): array
    {
        return [
            $employees->name,
            $employees->email,
            $employees->roles->first()->name,
            $employees->last_login_at,
            $employees->created_at,
        ];
    }

    public function collection()
    {
        return $this->employees;
    }

    public function headings() :array
    {
        return ["Name", "Email", "Role","Last Login", "Joined Date"];
    }
}
