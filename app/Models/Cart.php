<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // Jumlah total item (semua kuantitas)
    public function getTotalItemsAttribute()
    {
        return $this->items->sum('quantity');
    }

    // Jumlah item unik (produk berbeda)
    public function getUniqueItemsCountAttribute()
    {
        return $this->items->count();
    }

    public function getTotalPriceAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }

    public function getTotalAttribute()
    {
        return $this->items->sum(function($item) {
            return $item->price * $item->quantity;
        });
    }
}
