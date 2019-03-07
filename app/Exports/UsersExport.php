<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all();
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->email,
            $user->phone,
            $user->name,
            $user->birthday,
            $user->skype,
            $user->ADMsince,
        ];

    }

    public function headings(): array
    {
        return [
            'Id',
            'Email',
            'Phone',
            'Name',
            'Birthday',
            'Skype',
            'Adm_Since'
        ];
    }
}
