<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InstructorExport implements FromCollection, WithHeadings, WithMapping
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
            $users->whatsapp,
            $users->phone,
            $users->facebook,
            $users->cityList($users->areas),
            $users->areaList($users->areas),
            $users->specializationList($users->specializations),
        ];
    }

    public function collection()
    {
        return $this->users;
    }

    public function headings() :array
    {
        return ["Name", "Email", "Whatsapp", "Phone", "F.B Account", "Cities", "Areas", "specializations"];
    }
}
