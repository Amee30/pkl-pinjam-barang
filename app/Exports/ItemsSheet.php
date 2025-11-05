<?php
namespace App\Exports;

use App\Models\Barangs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ItemsSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return Barangs::all()->map(function($item, $index) {
            return [
                'no' => $index + 1,
                'nama_barang' => $item->nama_barang,
                'serial_number' => $item->serial_number ?? '-',
                'kategori' => $item->kategori,
                'stok' => $item->stok,
                'lokasi' => $item->lokasi ?? '-',
                'kondisi' => $item->kondisi,
                'qr_code' => $item->qr_code,
                'created_at' => $item->created_at->format('d/m/Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Item Name',
            'Serial Number',
            'Category',
            'Stock',
            'Location',
            'Condition',
            'QR Code',
            'Created At',
        ];
    }

    public function title(): string
    {
        return 'Items Data';
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
            'B' => 30,
            'C' => 20,
            'D' => 15,
            'E' => 10,
            'F' => 20,
            'G' => 15,
            'H' => 25,
            'I' => 20,
        ];
    }
}