<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $cart = Auth::user()->cart()->with(['items.product'])->firstOrCreate();
        return view('keranjang', compact('cart'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1|max:' . $product->stok
        ]);

        if ($product->stok < 1) {
            return response()->json([
                'success' => false,
                'message' => 'Stok produk habis'
            ], 400);
        }

        return DB::transaction(function () use ($request, $product) {
            $cart = Auth::user()->cart()->firstOrCreate();
            $quantity = $request->quantity ?? 1;

            // Lock produk untuk mencegah race condition
            $product = Product::lockForUpdate()->find($product->id);

            // Cek stok tersedia
            $availableStock = $product->stok;

            // Jika produk sudah ada di keranjang, hitung total quantity yang akan dimasukkan
            $existingItem = $cart->items()->where('product_id', $product->id)->first();
            $currentQuantityInCart = $existingItem ? $existingItem->quantity : 0;
            $totalQuantityAfterAdd = $currentQuantityInCart + $quantity;

            if ($totalQuantityAfterAdd > $availableStock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jumlah melebihi stok yang tersedia. Stok tersedia: ' . $availableStock . ', sudah di keranjang: ' . $currentQuantityInCart
                ], 400);
            }

            if ($existingItem) {
                $existingItem->update(['quantity' => $totalQuantityAfterAdd]);
            } else {
                $cart->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->harga
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan ke keranjang',
                'cartCount' => $cart->refresh()->unique_items_count,
                'availableStock' => $availableStock - $totalQuantityAfterAdd // Stok tersisa
            ]);
        });
    }

    public function update(Request $request, CartItem $item)
    {
        $item = CartItem::where('id', $item->id)
            ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
            ->with('product')
            ->firstOrFail();

        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $item->product->stok
        ]);

        $item->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Jumlah produk berhasil diperbarui');
    }

    public function destroy(CartItem $item)
    {
        $item = CartItem::where('id', $item->id)
            ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
            ->firstOrFail();

        $item->delete();

        return back()->with('success', 'Produk berhasil dihapus dari keranjang');
    }

    public function confirm(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $cart = Auth::user()->cart()->with(['items.product' => function ($q) {
                $q->lockForUpdate();
            }])->first();

            if (!$cart || $cart->items->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Keranjang belanja kosong'
                ], 400);
            }

            $request->validate([
                'customer_name' => 'required|string|max:255',
                'pgtpq' => 'required|string|max:255',
                'address' => 'required|string',
                'notes' => 'nullable|string'
            ]);

            // Hitung total amount
            $totalAmount = $cart->items->sum(function ($item) {
                return $item->price * $item->quantity;
            });

            // Validasi stok sebelum checkout
            foreach ($cart->items as $item) {
                if ($item->quantity > $item->product->stok) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Stok tidak mencukupi untuk produk: ' . $item->product->judul
                    ], 400);
                }
            }

            // Buat order baru
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => Auth::id(),
                'customer_name' => $request->customer_name,
                'pgtpq' => $request->pgtpq,
                'address' => $request->address,
                'notes' => $request->notes ?? '-',
                'total_amount' => $totalAmount,
                'status' => 'menunggu'
            ]);

            // Tambahkan item ke order
            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ]);

                // Kurangi stok
                $item->product->decrement('stok', $item->quantity);
            }

            // Kosongkan keranjang
            $cart->items()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dikonfirmasi',
                'order_number' => $order->order_number
            ]);
        });
    }

    public function thankYou()
    {
        return view('thankyou');
    }
}
