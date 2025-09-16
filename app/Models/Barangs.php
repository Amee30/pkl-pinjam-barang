<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangs extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'kategori',
        'serial_number',
        'stok',
        'foto',
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class, 'barang_id');
    }
}
