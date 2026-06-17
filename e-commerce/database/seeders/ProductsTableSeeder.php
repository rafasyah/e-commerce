<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultImage = 'products/SBebS40n1CQkfoiDtlGIG5LmSp6HU4vvQomUErCG.jpg';

        Products::create([
            'nama_barang' => 'Laptop Gaming RGB',
            'deskripsi' => 'Laptop gaming dengan keyboard RGB dan performa tinggi untuk gaming dan produktivitas.',
            'harga' => 15000000,
            'stok' => 5,
            'gambar' => $defaultImage
        ]);

        Products::create([
            'nama_barang' => 'Smartphone Pro Max',
            'deskripsi' => 'Smartphone flagship dengan kamera 108MP, layar AMOLED 120Hz, dan baterai 5000mAh.',
            'harga' => 8000000,
            'stok' => 10,
            'gambar' => $defaultImage
        ]);

        Products::create([
            'nama_barang' => 'Headset Wireless',
            'deskripsi' => 'Headset wireless dengan noise cancelling aktif, bass powerful, dan baterai 30 jam.',
            'harga' => 500000,
            'stok' => 15,
            'gambar' => $defaultImage
        ]);

        Products::create([
            'nama_barang' => 'Mouse Gaming RGB',
            'deskripsi' => 'Mouse gaming ergonomis dengan sensor optik 16000 DPI dan pencahayaan RGB customizable.',
            'harga' => 250000,
            'stok' => 20,
            'gambar' => $defaultImage
        ]);

        Products::create([
            'nama_barang' => 'Keyboard Mechanical',
            'deskripsi' => 'Keyboard mechanical dengan switch blue, RGB lighting, dan layout full size.',
            'harga' => 750000,
            'stok' => 8,
            'gambar' => $defaultImage
        ]);
    }
}
