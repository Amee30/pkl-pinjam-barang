<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barangs;

class BarangsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barangs::create(['nama_barang' => 'Laptop A', 'kategori' => 'Elektronik', 'stok' => 10]);
        Barangs::create(['nama_barang' => 'Proyektor B', 'kategori' => 'Elektronik', 'stok' => 5]);
        Barangs::create(['nama_barang' => 'Kabel HDMI', 'kategori' => 'Aksesoris', 'stok' => 20]);
    }
}
