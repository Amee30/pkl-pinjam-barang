<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\AllDataExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Barangs;
use App\Models\User;
use App\Models\BarangMovement;
use App\Models\Borrowing;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    /**
     * Export all data to Excel (multi-sheet)
     */
    public function exportExcel()
    {
        $filename = 'All_Data_Export_' . date('Y-m-d_His') . '.xlsx';
        return Excel::download(new AllDataExport, $filename);
    }

    /**
     * Export all data to PDF (multi-page)
     */
    public function exportPdf()
    {
        // Get all data
        $items = Barangs::all();
        $users = User::all();
        $movements = BarangMovement::with(['barang', 'user'])->get();
        $borrowings = Borrowing::with(['user', 'barang'])->get();

        // Generate PDF
        $pdf = PDF::loadView('exports.all-data-pdf', compact('items', 'users', 'movements', 'borrowings'));
        
        // Set paper size to A4 landscape for better table display
        $pdf->setPaper('a4', 'landscape');
        
        $filename = 'All_Data_Export_' . date('Y-m-d_His') . '.pdf';
        
        return $pdf->download($filename);
    }

    /**
     * Show export options page
     */
    public function showExportOptions()
    {
        // Get stats untuk ditampilkan
        $stats = [
            'items' => Barangs::count(),
            'users' => User::count(),
            'movements' => BarangMovement::count(),
            'borrowings' => Borrowing::count(),
        ];

        return view('admin.export.options', compact('stats'));
    }
}