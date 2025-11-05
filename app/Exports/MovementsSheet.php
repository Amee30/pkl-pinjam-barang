<?php
namespace App\Exports;

use App\Models\BarangMovement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MovementsSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return BarangMovement::with(['barang', 'user'])->get()->map(function($movement, $index) {
            return [
                'no' => $index + 1,
                'date' => $movement->date->format('d/m/Y'),
                'item_name' => $movement->barang->nama_barang,
                'type' => strtoupper($movement->type),
                'quantity' => $movement->quantity,
                'source' => $movement->source ?? '-',
                'reason' => $movement->reason,
                'notes' => $movement->notes ?? '-',
                'user' => $movement->user->name,
                'created_at' => $movement->created_at->format('d/m/Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Date',
            'Item Name',
            'Type',
            'Quantity',
            'Source',
            'Reason',
            'Notes',
            'User',
            'Created At',
        ];
    }

    public function title(): string
    {
        return 'Movements History';
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
            'B' => 12,
            'C' => 25,
            'D' => 8,
            'E' => 10,
            'F' => 20,
            'G' => 25,
            'H' => 30,
            'I' => 20,
            'J' => 20,
        ];
    }
}