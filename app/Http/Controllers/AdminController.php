<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barangs;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $barangs = Barangs::all();
        $borrowing = Borrowing::with('user', 'barang')->get();
        return view('admin.dashboard', compact('barangs', 'borrowing'));
    }

    public function approve(Borrowing $borrowing)
    {
        $borrowing->status = 'approved';
        $borrowing->save();

        return redirect()->back()->with('success', 'Peminjaman disetujui.');
    }

    public function return(Borrowing $borrowing)
    {
        $borrowing->status = 'returned';
        $borrowing->save();

        $barang = Barangs::find($borrowing->barang_id);
        if ($barang) {
            $barang->increment('stock');
        }

        return redirect()->back()->with('success', 'Barang telah dikembalikan.');
    }

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barangs::all();
        return view('admin.barangs.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.barangs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        
        $data = $request->only(['nama_barang', 'kategori', 'stok']);
        
        if ($request->hasFile('foto')) {
            // Simpan file di storage/app/public/barangs
            $path = $request->file('foto')->store('barangs', 'public');
            $data['foto'] = $path;
        }
        
        Barangs::create($data);
        
        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barangs $barang)
    {
        return view('admin.barangs.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barangs $barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        
        $data = $request->only(['nama_barang', 'kategori', 'stok']);
        
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            // Hapus foto lama jika ada
            if ($barang->foto && Storage::disk('public')->exists($barang->foto)) {
                Storage::disk('public')->delete($barang->foto);
            }
            
            // Simpan file baru
            $path = $request->file('foto')->store('barangs', 'public');
            $data['foto'] = $path;
        }
        
        $barang->update($data);
        
        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barangs $barang)
    {
        $barang->delete();
        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
