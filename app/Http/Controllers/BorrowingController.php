<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barangs;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Auth;  
use Barryvdh\DomPDF\Facade\Pdf;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get filter kategori dari request
        $kategori = $request->get('kategori');
        
        // Query barang dengan filter
        $barangsQuery = Barangs::query();
        
        if ($kategori && $kategori !== 'all') {
            $barangsQuery->where('kategori', $kategori);
        }
        
        $barangs = $barangsQuery->get();
        
        // Get semua kategori unik untuk dropdown
        $categories = Barangs::select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');
        
        $borrowings = Borrowing::where('user_id', Auth::id())->with('barang')->get();

        return view('dashboard', compact('barangs', 'borrowings', 'categories', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Barangs $barangs)
    {
        return view('borrowing.create', compact('barangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'borrowed_at' => 'required|date',
            'return_due_date' => 'required|date|after:borrowed_at',
            'reason' => 'nullable|string|max:255',
        ]);

        $barangs = Barangs::find($request->barang_id);

        if ($barangs->stok < 1) {
            return redirect()->back()->withErrors(['stock' => 'Insufficient stock.']);
        }

        Borrowing::create([
            'user_id' => Auth::id(),
            'barang_id' => $request->barang_id,
            'borrowed_at' => $request->borrowed_at,
            'return_due_date' => $request->return_due_date,
            'status' => 'pending',
            'reason' => $request->reason,
        ]);

        return redirect()->route('dashboard')->with('success', 'Borrowing request submitted successfully.');
    }

    public function returnItem(Request $request, Borrowing $borrowing){
        // Pastikan peminjaman ada dan statusnya adalah 'borrowed'
        if ($borrowing->user_id !== Auth::id()){
            abort(403, 'You do not have access to return this borrowing.');
        }

        // Cek status peminjaman
        if ($borrowing->status !== 'borrowed'){
            return redirect()->back()->with('error', 'This item is not currently borrowed.');
        }

        $borrowing->update(['status' => 'waiting_return']);

        return redirect()->route('pinjam.history')->with('success', 'Return Request Submitted. Please bring the item to admin for scanning');


    }

    /**
     * Display the specified resource.
     */
    public function show(Borrowing $borrowing)
    {
        // Explicitly check if user is admin first
        if (Auth::user()->role == 'admin') {
            $userId = $borrowing->user_id;
            $userStats = [
                'total' => Borrowing::where('user_id', $userId)->count(),
                'active' => Borrowing::where('user_id', $userId)->where('status', 'borrowed')->count(),
                'completed' => Borrowing::where('user_id', $userId)->where('status', 'returned')->count(),
                'rejected' => Borrowing::where('user_id', $userId)->where('status', 'rejected')->count(),
                'pending' => Borrowing::where('user_id', $userId)->where('status', 'pending')->count(),
            ];
            return view('borrowing.show', compact('borrowing', 'userStats'));
        }
        
        // If not admin, check if it's their own borrowing
        if ($borrowing->user_id !== Auth::id()) {
            abort(403, 'You do not have access to view this borrowing.');
        }

        return view('borrowing.show', compact('borrowing'));
    }

    
    public function edit(Borrowing $borrowing)
    {
        if ($borrowing->user_id !== Auth::id() || $borrowing->status !== 'pending') {
            abort(403);
        }

        return view('borrowing.edit', compact('borrowing'));
    }

    
    public function update(Request $request, Borrowing $borrowing)
    {
        if ($borrowing->user_id !== Auth::id() || $borrowing->status !== 'pending') {
            abort(403);
        }

        $request->validate([
            'return_due_date' => 'required|date|after:today',
        ]);

        $borrowing->update([
            'return_due_date' => $request->return_due_date,
        ]);

        return redirect()->route('dashboard')->with('success', 'Borrowing request updated successfully.');
    }

    
    public function destroy(Borrowing $borrowing)
    {
        if ($borrowing->user_id !== Auth::id() || $borrowing->status !== 'pending') {
            abort(403);
        }
        $borrowing->delete();
        return redirect()->route('dashboard')->with('success', 'Borrowing request cancelled successfully.');
    }

    public function history(){
        $borrowings = Borrowing::where('user_id', Auth::id())->with('barang')->orderBy('created_at', 'desc')->paginate(5);
        return view('borrowing.history', compact('borrowings'));
    }

    public function generateReceipt(Borrowing $borrowing)
    {
        // cek status peminjaman
        if ($borrowing->status != 'approved' && $borrowing->status != 'borrowed' && $borrowing->status != 'returned') {
            abort(403, 'Receipt can only be generated for approved, borrowed, or returned borrowings.');
        }

        // Cek apakah pengguna adalah admin 
        if (Auth::id() !== $borrowing->user_id && Auth::user()->role !== 'admin') {
            abort(403, 'You do not have access to this receipt.');
        }
        
        // Generate PDF 
        $pdf = PDF::loadView('borrowing.receipt-pdf', compact('borrowing'));
        
        // Set paper size ke A4
        $pdf->setPaper('a4');
        
        return $pdf->stream('Borrowing_Receipt_'. $borrowing->id .'.pdf');
    }
}
