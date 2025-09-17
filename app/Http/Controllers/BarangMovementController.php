<?php

namespace App\Http\Controllers;

use App\Models\Barangs;
use App\Models\BarangMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangMovementController extends Controller
{
    /**
     * Menampilkan daftar pergerakan barang
     */
    public function index()
    {
        $movements = BarangMovement::with(['barang', 'user'])->latest()->paginate(10);
        return view('admin.movements.index', compact('movements'));
    }

    /**
     * Menampilkan form tambah pergerakan barang
     */
    public function create()
    {
        $barangs = Barangs::all();
        return view('admin.movements.create', compact('barangs'));
    }

    /**
     * Menyimpan data pergerakan barang
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'source' => 'nullable|string|max:255',
            'reason' => 'required|string|max:255',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        // Ambil data barang
        $barang = Barangs::findOrFail($request->barang_id);

        // Cek stok untuk pergerakan keluar
        if ($request->type == 'out' && $barang->stok < $request->quantity) {
            return redirect()->back()->withErrors(['quantity' => 'Stok barang tidak mencukupi.'])->withInput();
        }

        // Update stok barang
        if ($request->type == 'in') {
            $barang->increment('stok', $request->quantity);
        } else {
            $barang->decrement('stok', $request->quantity);
        }

        // Simpan data pergerakan
        BarangMovement::create([
            'barang_id' => $request->barang_id,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'source' => $request->source,
            'reason' => $request->reason,
            'date' => $request->date,
            'notes' => $request->notes,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.movements.index')->with('success', 'Data pergerakan barang berhasil disimpan.');
    }

    public function show(BarangMovement $movement){
        // Load relationships
        $movement->load(['barang', 'user']);
        
        return view('admin.movements.show', compact('movement'));
    }
}
