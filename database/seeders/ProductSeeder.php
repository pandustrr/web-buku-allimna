<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'judul' => 'Sapiens: Riwayat Singkat Umat Manusia',
            'penulis' => 'Yuval Noah Harari',
            'deskripsi' => 'Buku yang mengisahkan sejarah manusia dari zaman batu hingga revolusi teknologi.',
            'harga' => 125000,
            'stok' => 50,
            'halaman' => 525,
            'bahasa' => 'Indonesia',
            'panjang' => 20.3,
            'lebar' => 13.5,
            'berat' => 650,
            'foto' => 'sapiens.jpg'
        ]);

        Product::create([
            'judul' => 'Atomic Habits',
            'penulis' => 'James Clear',
            'deskripsi' => 'Buku tentang membangun kebiasaan baik dan menghilangkan kebiasaan buruk.',
            'harga' => 98000,
            'stok' => 30,
            'halaman' => 320,
            'bahasa' => 'Indonesia',
            'panjang' => 19.0,
            'lebar' => 12.8,
            'berat' => 450,
            'foto' => 'atomic-habits.jpg'
        ]);
    }
}
