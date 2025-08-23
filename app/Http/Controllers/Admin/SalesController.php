<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'daily');

        $query = Order::query()->with(['items', 'user']);

        switch ($period) {
            case 'weekly':
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                $query->whereBetween('created_at', [$startDate, $endDate]);
                break;
            case 'monthly':
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                $query->whereBetween('created_at', [$startDate, $endDate]);
                break;
            default: // daily
                $query->whereDate('created_at', Carbon::today());
        }

        $orders = $query->latest()->paginate(10);
        $totalSales = $query->sum('total_amount');
        $totalOrders = $query->count();

        return view('admin.sales.index', compact(
            'orders',
            'totalSales',
            'totalOrders',
            'period'
        ));
    }

    public function show(Order $order)
    {
        return view('admin.sales.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:diproses,selesai,dibatalkan'
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui');
    }

public function destroy(Order $order)
{
    DB::transaction(function () use ($order) {
        // Kembalikan stok produk jika pesanan dibatalkan/dihapus
        if ($order->status !== 'dibatalkan') {
            foreach ($order->items as $item) {
                $item->product->increment('stok', $item->quantity);
            }
        }

        // Hapus item order terlebih dahulu
        $order->items()->delete();

        // Hapus order
        $order->delete();
    });

    return redirect()->route('admin.sales.index')
        ->with('success', 'Pesanan berhasil dihapus');
}
}
