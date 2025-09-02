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

        return view('dashboard', compact('barangs'));
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

        if ($barangs->stock < 1) {
            return redirect()->back()->withErrors(['stock' => 'Barang Tidak Tersedia Saat Ini.']);
        }

        Borrowing::create([
            'user_id' => Auth::id(),
            'barang_id' => $request->barang_id,
            'borrowed_at' => now(),
            'return_due_date' => $request->return_due_date,
            'status' => 'pending',
        ]);

        $barangs->decrement('stock');
        return redirect()->route('dashboard')->with('success', 'Permintaan Peminjaman Berhasil Diajukan.');
    }

   
    // public function show(string $id)
    // {
    //     //
    // }

    
    // public function edit(string $id)
    // {
    //     //
    // }

    
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    
    // public function destroy(string $id)
    // {
    //     //
    // }
}
