<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Car;
use App\Models\User;
use App\Models\Brand;

class ReportController extends Controller
{


    public function orderReport(Request $request)
    {
        $cars = Car::all();
        $brands = Brand::all();
        $users = User::all();

        $query = Order::query()->with('car', 'user', 'car.brand');

        // Filters
        if ($request->filled('car_id')) {
            $query->where('car_id', $request->car_id);
        }

        if ($request->filled('brand_id')) {
            $query->whereHas('car', function ($q) use ($request) {
                $q->where('brand_id', $request->brand_id);
            });
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        } else {
            // Default: only completed
            $query->where('status', 'completed');
        }

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        } elseif ($request->input('date_filter') == 'today') {
            $query->whereDate('created_at', today());
        }

        $orders = $query->latest()->get();
        $totalGrand = $orders->sum('grand_total');

        return view('admin.reports.index', compact('orders', 'cars', 'brands', 'users', 'totalGrand'));
    }
}
