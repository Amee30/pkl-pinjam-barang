<?php
namespace App\Exports;

use App\Models\Barangs;
use App\Models\User;
use App\Models\BarangMovement;
use App\Models\Borrowing;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AllDataExport implements WithMultipleSheets
{
    /**
     * @return array
     */
    public function sheets(): array
    {
        return [
            new ItemsSheet(),
            new UsersSheet(),
            new MovementsSheet(),
            new BorrowingsSheet(),
        ];
    }
}