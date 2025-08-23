<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'penulis',
        'deskripsi',
        'harga',
        'stok',
        'reserved_stock', // Kolom baru untuk stok yang dipesan
        'foto',
        'halaman',
        'panjang',
        'lebar',
        'berat'
    ];

    protected $attributes = [
        'judul' => 'Tanpa Judul',
        'penulis' => '-',
        'deskripsi' => '-',
        'harga' => 0,
        'stok' => 0,
        'reserved_stock' => 0, // Default value
        'halaman' => null,
        'panjang' => null,
        'lebar' => null,
        'berat' => null,
        'foto' => null
    ];

    // Accessor untuk foto
    public function getFotoUrlAttribute()
    {
        return $this->foto ? asset('storage/' . $this->foto) : asset('images/default-book.png');
    }

    public function getAvailableStockAttribute()
    {
        return $this->stok; 
    }
}
