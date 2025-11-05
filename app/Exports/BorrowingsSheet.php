<?php
namespace App\Exports;

use App\Models\Borrowing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BorrowingsSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return Borrowing::with(['user', 'barang'])->get()->map(function($borrowing, $index) {
            return [
                'no' => $index + 1,
                'borrower' => $borrowing->user->name,
                'department' => $borrowing->user->department ?? '-',
                'phone' => $borrowing->user->phone_number ?? '-',
                'item_name' => $borrowing->barang->nama_barang,
                'serial_number' => $borrowing->barang->serial_number ?? '-',
                'borrow_date' => $borrowing->created_at->format('d/m/Y'),
                'return_due_date' => $borrowing->return_due_date ? \Carbon\Carbon::parse($borrowing->return_due_date)->format('d/m/Y') : '-',
                'reason' => $borrowing->reason,
                'status' => strtoupper($borrowing->status),
                'created_at' => $borrowing->created_at->format('d/m/Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Borrower',
            'Department',
            'Phone',
            'Item Name',
            'Serial Number',
            'Borrow Date',
            'Return Due Date',
            'Reason',
            'Status',
            'Created At',
        ];
    }

    public function title(): string
    {
        return 'Borrowing History';
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
            'C' => 20,
            'D' => 18,
            'E' => 25,
            'F' => 20,
            'G' => 15,
            'H' => 18,
            'I' => 35,
            'J' => 15,
            'K' => 20,
        ];
    }
}