<?php

namespace App\Http\Controllers;

use App\Models\BarangMovement;
use Illuminate\Http\Request;
use App\Models\Barangs;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $barangs = Barangs::all();
        $borrowing = Borrowing::with('user', 'barang')->get();

        //Stats 
        $totalBarangs = Barangs::sum('stok');
        $totalJenisBarang = Barangs::count();
        $totalUser = User::count();
        $activeBorrowers = Borrowing::where('status', 'borrowed')->count();

        $barangMasuk = BarangMovement::where('type', 'in')->sum('quantity');
        $barangKeluar = BarangMovement::where('type', 'out')->sum('quantity');

        // Pagination 5 items per page
        $borrowing = Borrowing::with(['user', 'barang'])->latest()->paginate(5);

        return view('admin.dashboard', compact('barangs', 'borrowing', 'totalBarangs', 'totalJenisBarang', 'totalUser', 'activeBorrowers', 'barangMasuk', 'barangKeluar'));
    }

    public function approve(Request $request, $borrowing_id)
    {
        // Cari peminjaman berdasarkan ID
        $borrowing = Borrowing::findOrFail($borrowing_id);

        // Periksa kalau barang masih ada stok
        if (!$borrowing->barang || $borrowing->barang->stok < 1) {
            return redirect()->back()->with('stok', 'Stok barang tidak mencukupi untuk menyetujui peminjaman.');
        }

        // Update status peminjaman menjadi 'borrowed'
        $borrowing->update(
            ['status' => 'borrowed']
        );

        // Kurangi stok barang
        $borrowing->barang->decrement('stok');

        // Catat pergerakan barang keluar
        BarangMovement::create(
            [
                'barang_id' => $borrowing->barang_id,
                'type' => 'out',
                'quantity' => 1,
                'source' => null,
                'reason' => 'Borrowed by '. $borrowing->user->name,
                'date' => now()->format('Y-m-d'),
                'notes' => 'Borrower ID'. $borrowing->user_id,
                'user_id' => Auth::id(),
            ]
            );

        return redirect()->back()->with('success', 'Borrowing approved.');
    }

    public function return(Request $request, $borrowing_id)
    {
        // Temukan peminjam berdasarkan ID
        $borrowing = Borrowing::with('barang', 'user')->findOrFail($borrowing_id);

        // Pastikan peminjaman ada dan statusnya adalah 'borrowed'
        $borrowing->update(['status' => 'returned']);

        if ($borrowing->barang) {
            $borrowing->barang->increment('stok');
            // Catat pergerakan barang masuk
            BarangMovement::create([
                'barang_id' => $borrowing->barang_id,
                'type' => 'in',
                'quantity' => 1,
                'source' => 'Return Borrowing',
                'reason' => 'Returned by ' . $borrowing->user->name,
                'date' => now()->format('Y-m-d'),
                'notes' => 'Return from Borrower ID ' . $borrowing->id,
                'user_id' => Auth::id(),
            ]);
        }


        return redirect()->back()->with('success', 'The item has been returned.');
    }

    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategori = $request->input('kategori');

        $barangsQuery = Barangs::query();

        if ($kategori && $kategori !== 'All') {
            $barangsQuery->where('kategori', $kategori);
        }

        $barangs = $barangsQuery->paginate(5);

        $categories = Barangs::select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        return view('admin.barangs.index', compact('barangs', 'categories', 'kategori'));
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
            'serial_number' => 'nullable|string|max:255',
            'stok' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'source' => 'required|string|max:255',
        ]);
        
        $data = $request->only(['nama_barang', 'kategori', 'serial_number' ,'stok']);
        
        if ($request->hasFile('foto')) {
            // Simpan file di storage/app/public/barangs
            $path = $request->file('foto')->store('barangs', 'public');
            $data['foto'] = $path;
        }
        
        Barangs::create($data);

        BarangMovement::create([
            'barang_id' => Barangs::latest()->first()->id,
            'type' => 'in',
            'quantity' => $request->stok,
            'source' => $request->source,
            'reason' => 'Initial Stock by admin ',
            'date' => now()->format('Y-m-d'),
            'notes' => 'Added by admin '. Auth::user()->name,
            'user_id' => Auth::id(),
        ]);
        
        return redirect()->route('admin.barang.index')->with('success', 'Item added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $barang = Barangs::findOrFail($id);
        return view('admin.barangs.show', compact('barang'));
    }

    public function getDetails(string $id)
    {
        $barang = Barangs::findOrFail($id);
        return response()->json($barang);
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
            'serial_number' => 'nullable|string|max:255',
            'stok' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        
        $data = $request->only(['nama_barang', 'kategori', 'serial_number' ,'stok']);

        $oldStock = $barang->stok;
        $newStock = $request->stok;
        $stockDifference = $newStock - $oldStock;

        $data['stok'] = $newStock;

        
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
        
        if ($stockDifference != 0) {
            BarangMovement::create([
                'barang_id' => $barang->id,
                'type' => $stockDifference > 0 ? 'in' : 'out',
                'quantity' => abs($stockDifference),
                'source' => $stockDifference > 0 ? 'Stock Addition' : 'Stock Reduction',
                'reason' => $stockDifference > 0 ? 'Stock added by admin '. Auth::user()->name : 'Stock reduced by admin '. Auth::user()->name,
                'date' => now()->format('Y-m-d'),
                'notes' => $stockDifference > 0 ? 'Stock added from '.$oldStock.' to '.$newStock : 'Stock reduced from '.$oldStock.' to '.$newStock,
                'user_id' => Auth::id(),
            ]);
        }
        return redirect()->route('admin.barang.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barangs $barang)
    {
        $barang->delete();
        return redirect()->route('admin.barang.index')->with('success', 'Item deleted successfully.');
    }
    
    /**
     * Reject borrowing request
     */
    public function reject(Request $request, $borrowing_id)
    {
        // Validasi request
        $request->validate([
            'reject_reason' => 'required|string|max:255',
        ]);

        // Cari peminjaman berdasarkan ID
        $borrowing = Borrowing::findOrFail($borrowing_id);

        // Pastikan status masih pending
        if ($borrowing->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending borrowings can be rejected.');
        }

        // Update status peminjaman menjadi 'rejected' dan tambahkan alasan
        $borrowing->update([
            'status' => 'rejected',
            'reject_reason' => $request->reject_reason
        ]);

        return redirect()->back()->with('success', 'Borrowing rejected successfully.');
    }
}