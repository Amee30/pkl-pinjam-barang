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
        Barangs::create([
            'name_barang' => 'Laptop Dell Inspiron',
            'kategori' => 'Laptop',
            'serial_number' => 'DL123456',
            'stok' => 1,
        ]);

        Barangs::create([
            'name_barang' => 'Proyektor Epson',
            'kategori' => 'Proyektor',
            'serial_number' => 'EP123456',
            'stok' => 1,
        ]);

        Barangs::create([
            'name_barang' => 'Kamera Canon EOS',
            'kategori' => 'Kamera',
            'serial_number' => 'CA123456',
            'stok' => 1,
        ]);

        Barangs::create([
            'name_barang' => 'Kabel Data Type-C',
            'kategori' => 'Aksesoris',
            'stok' => 50,
        ]);
        
    }
}
