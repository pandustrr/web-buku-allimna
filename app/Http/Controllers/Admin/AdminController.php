<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalStock = Product::sum('stok');
        $outOfStockProducts = Product::where('stok', 0)->count();
        $inventoryValue = Product::sum(DB::raw('harga * stok'));

        $recentProducts = Product::latest()->take(5)->get();
        $lowStockProducts = Product::where('stok', '>', 0)
            ->where('stok', '<=', 5)
            ->orderBy('stok')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalStock',
            'outOfStockProducts',
            'inventoryValue',
            'recentProducts',
            'lowStockProducts'
        ));
    }

    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'judul' => 'nullable|max:255',
            'penulis' => 'nullable|max:255',
            'deskripsi' => 'nullable',
            'harga' => 'nullable|numeric|min:0',
            'stok' => 'nullable|integer|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'halaman' => 'nullable|integer|min:1',
            // 'bahasa' => 'nullable|string',
            'panjang' => 'nullable|numeric|min:0',
            'lebar' => 'nullable|numeric|min:0',
            'berat' => 'nullable|numeric|min:0',
        ]);

        // Memasto
        $validated = array_merge([
            'judul' => 'Tanpa Judul',
            'penulis' => '-',
            'deskripsi' => '-',
            'harga' => 0,
            'stok' => 0,
            // 'bahasa' => 'Indonesia'
        ], array_filter($validated, fn($v) => !is_null($v)));

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }


    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'penulis' => 'required|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'halaman' => 'nullable|integer|min:1',
            // 'bahasa' => 'required|string',
            'panjang' => 'nullable|numeric|min:0',
            'lebar' => 'nullable|numeric|min:0',
            'berat' => 'nullable|numeric|min:0',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($product->foto) {
                Storage::disk('public')->delete($product->foto);
            }
            $validated['foto'] = $request->file('foto')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        // Hapus foto jika ada
        if ($product->foto) {
            Storage::disk('public')->delete($product->foto);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}
