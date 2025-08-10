<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $statusCounts = Order::select('status', DB::raw('COUNT(*) as count'))
            ->whereIn('status', ['pending', 'delivered', 'returned', 'cancelled'])
            ->groupBy('status')
            ->pluck('count', 'status');
        // نضمن وجود القيم حتى لو الحالة مش موجودة في النتائج 
        $pendingCount   = $statusCounts['pending']   ?? 0;
        $deliveredCount = $statusCounts['delivered'] ?? 0;
        $returnedCount  = $statusCounts['returned']  ?? 0;
        $cancelledCount = $statusCounts['cancelled'] ?? 0;
        
        // Graph - Monthly Sales (only delivered)
        $monthlySales = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total_orders')
        )
            ->whereYear('created_at', Carbon::now()->year)
            ->where('status', 'delivered')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->pluck('total_orders', 'month');

        // Card - Total Products
        $totalProducts = Product::count();

        // Card - Top Selling Product
        $topSellingProduct = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('orders.status', 'delivered')
            ->select('products.name', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->groupBy('products.name')
            ->orderByDesc('total_sold')
            ->first();

        return view('admin.dashboard', compact(
            'pendingCount',
            'deliveredCount',
            'returnedCount',
            'cancelledCount',
            'monthlySales',
            'totalProducts',
            'topSellingProduct'
        ));
    }
}
