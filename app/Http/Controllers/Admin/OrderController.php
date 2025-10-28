<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        // If date range is set
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('created_at', '>=', $request->start_date)
                ->whereDate('created_at', '<=', $request->end_date);
        }

        $orders = $query->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }


    public function show(Order $order)
    {
        $order = Order::with('car')->findOrFail($order->id);
        if (!$order->is_read) {
            $order->update(['is_read' => true]);
        }

        return view('admin.orders.view', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $order->update(['status' => $validated['status']]);

        // Send status update email to user
        Mail::to($order->email)->send(new \App\Mail\OrderStatusUpdated($order));

        return back()->with('success', 'Order status updated and user notified.');
    }


    public function updatePaymentStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:paid,unpaid',
        ]);
        $order->update(['payment_status' => $validated['payment_status']]);
        return back()->with('success', 'Payment Status Updated Successfully');

    }

    public function destroy(Order $order)
    {
        $email = $order->email;
        $order->delete();

        // Send order deletion email
        Mail::to($email)->send(new \App\Mail\OrderDeleted($order));

        return back()->with('success', 'Order deleted and user notified.');
    }
}
