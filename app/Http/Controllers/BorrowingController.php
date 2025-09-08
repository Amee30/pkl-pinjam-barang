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
        ]);

        return redirect()->route('dashboard')->with('success', 'Permintaan Peminjaman Berhasil Diajukan.');
    }

   
    public function show(Borrowing $borrowing)
    {
        if ($borrowing->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403);
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
