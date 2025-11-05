<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return User::all()->map(function($user, $index) {
            return [
                'no' => $index + 1,
                'name' => $user->name,
                'email' => $user->email,
                'role' => ucfirst($user->role),
                'department' => $user->department ?? '-',
                'phone_number' => $user->phone_number ?? '-',
                'created_at' => $user->created_at->format('d/m/Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Name',
            'Email',
            'Role',
            'Department',
            'Phone Number',
            'Registered At',
        ];
    }

    public function title(): string
    {
        return 'Users Data';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 25,
            'C' => 30,
            'D' => 12,
            'E' => 20,
            'F' => 18,
            'G' => 20,
        ];
    }
}