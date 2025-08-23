<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'password',
        'temp_password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['cart_items_count'];

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    // Method untuk menghitung jumlah item unik di keranjang
    public function cart_items_count()
    {
        if ($this->cart) {
            return $this->cart->items()->count(); // Menghitung jumlah item unik
        }

        return 0;
    }

    // Accessor untuk memudahkan akses
    public function getCartItemsCountAttribute()
    {
        return $this->cart_items_count();
    }
}
