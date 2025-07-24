<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    private $OrderService;
    public function __construct(OrderService $OrderService)
    {
        $this->OrderService = $OrderService;
    }
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'status']);
        $orders = $this->OrderService->getOrders($filters);
        return view('admin.orders.index', compact('orders'));
    }
    public function show($id)
    {
        $order = $this->OrderService->OrderDetails($id);
        return view('admin.orders.show', compact('order'));
    }
    public function updateStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required|in:pending,processing,failed_to_delivery,shipped,delivered,cancelled',
        ]);
        $order=$this->OrderService->UpdateStatus($request->order_id, $request->status);

        return response()->json([
            'message' => 'Status updated successfully',
        ]);
    }
    public function destroy($id)
    {
        Order::destroy($id);
        return back()->with("success", "Order Deleted Successfully");
    }
}
