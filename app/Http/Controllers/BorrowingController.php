<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barangs;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Auth;  

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barangs::all();
        $borrowings = Borrowing::where('user_id', Auth::id())->with('barang')->get();

        return view('dashboard', compact('barangs', 'borrowings'));
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
            return redirect()->back()->withErrors(['stock' => 'Barang Tidak Tersedia Saat Ini.']);
        }

        Borrowing::create([
            'user_id' => Auth::id(),
            'barang_id' => $request->barang_id,
            'borrowed_at' => $request->borrowed_at,
            'return_due_date' => $request->return_due_date,
            'status' => 'pending',
            'reason' => $request->reason,
        ]);

        return redirect()->route('dashboard')->with('success', 'Permintaan Peminjaman Berhasil Diajukan.');
    }

    public function returnItem(Request $request, Borrowing $borrowing){
        // Pastikan peminjaman ada dan statusnya adalah 'borrowed'
        if ($borrowing->user_id !== Auth::id()){
            abort(403, 'Anda tidak memiliki akses untuk mengembalikan peminjaman ini.');
        }

        // Cek status peminjaman
        if ($borrowing->status !== 'borrowed'){
            return redirect()->back()->with('error', 'Barang ini tidak dalam status peminjaman');
        }

        $borrowing->update(['status' => 'returned']);

        if ($borrowing->barang) {
            $borrowing->barang->increment('stok');
            // Catat pergerakan barang masuk
            \App\Models\BarangMovement::create([
                'barang_id' => $borrowing->barang_id,
                'type' => 'in',
                'quantity' => 1,
                'source' => 'Pengembalian Peminjaman',
                'reason' => 'Dikembalikan oleh ' . $borrowing->user->name,
                'date' => now()->format('Y-m-d'),
                'notes' => 'Pengembalian dari Peminjam ID ' . $borrowing->id,
                'user_id' => Auth::id(),
            ]);
        }

        return redirect()->route('pinjam.history')->with('success', 'Barang telah dikembalikan.');


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
            abort(403, 'Anda tidak memiliki akses untuk melihat peminjaman ini.');
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

        return redirect()->route('dashboard')->with('success', 'Permintaan Peminjaman Berhasil Diperbarui.');
    }

    
    public function destroy(Borrowing $borrowing)
    {
        if ($borrowing->user_id !== Auth::id() || $borrowing->status !== 'pending') {
            abort(403);
        }
        $borrowing->delete();
        return redirect()->route('dashboard')->with('success', 'Permintaan Peminjaman Berhasil Dibatalkan.');
    }

    public function history(){
        $borrowings = Borrowing::where('user_id', Auth::id())->with('barang')->orderBy('created_at', 'desc')->get();
        return view('borrowing.history', compact('borrowings'));
    }
}
