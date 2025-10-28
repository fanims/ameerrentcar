<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;



class DashboardController extends Controller
{



public function index(Request $request)
{
    $dateRange = $request->get('date_range');
    $startDate = null;
    $endDate = null;

    if ($dateRange) {
        [$startDate, $endDate] = explode(' - ', $dateRange);
        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();
    }

    // Orders
    $ordersQuery = Order::query();
    if ($startDate && $endDate) {
        $ordersQuery->whereBetween('created_at', [$startDate, $endDate]);
    }
    $order_counts = $ordersQuery->count();

    // Brands
    $brandsQuery = Brand::query();
    if ($startDate && $endDate) {
        $brandsQuery->whereBetween('created_at', [$startDate, $endDate]);
    }
    $brand_counts = $brandsQuery->count();

    // Cars
    $carsQuery = Car::query();
    if ($startDate && $endDate) {
        $carsQuery->whereBetween('created_at', [$startDate, $endDate]);
    }
    $car_counts = $carsQuery->count();

    // Users
    $usersQuery = User::query();
    if ($startDate && $endDate) {
        $usersQuery->whereBetween('created_at', [$startDate, $endDate]);
    }
    $user_counts = $usersQuery->count();

    // Monthly Sales
    $monthly_sales_query = Order::select(
        DB::raw('MONTH(created_at) as month'),
        DB::raw('SUM(grand_total) as total')
    );
    if ($startDate && $endDate) {
        $monthly_sales_query->whereBetween('created_at', [$startDate, $endDate]);
    }
    $monthly_sales = $monthly_sales_query
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy(DB::raw('MONTH(created_at)'))
        ->pluck('total', 'month')
        ->toArray();

    $sales_data = [];
    for ($i = 1; $i <= 12; $i++) {
        $sales_data[] = $monthly_sales[$i] ?? 0;
    }

    // Monthly Orders
    $monthly_orders_query = Order::select(
        DB::raw('MONTH(created_at) as month'),
        DB::raw('COUNT(*) as count')
    );
    if ($startDate && $endDate) {
        $monthly_orders_query->whereBetween('created_at', [$startDate, $endDate]);
    }
    $monthly_orders = $monthly_orders_query
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy(DB::raw('MONTH(created_at)'))
        ->pluck('count', 'month')
        ->toArray();

    $order_data = [];
    for ($i = 1; $i <= 12; $i++) {
        $order_data[] = $monthly_orders[$i] ?? 0;
    }

    return view('admin.dashboard', compact(
        'order_counts',
        'brand_counts',
        'car_counts',
        'user_counts',
        'sales_data',
        'order_data'
    ));
}

}
