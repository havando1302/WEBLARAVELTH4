<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $date = $request->input('date');
        $queryDate = $date ? Carbon::parse($date) : Carbon::today();

        $totalRevenue = Order::whereDate('created_at', $queryDate)
                              ->where('status', '!=', 'cancelled')
                              ->sum('total');

        $totalOrders = Order::whereDate('created_at', $queryDate)
                            ->where('status', '!=', 'cancelled')
                            ->count();

        $totalCustomers = User::whereHas('orders', function ($query) use ($queryDate) {
            $query->whereDate('created_at', '<=', $queryDate)
                  ->where('status', '!=', 'cancelled');
        })->count();

        $totalProducts = Product::whereDate('created_at', '<=', $queryDate)->count();

        $newOrders = Order::whereDate('created_at', $queryDate)
                          ->where('status', '!=', 'cancelled')
                          ->count();

        $newCustomers = User::whereDate('created_at', $queryDate)->count();

        $newProducts = Product::whereDate('created_at', $queryDate)->count();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'totalCustomers',
            'totalProducts',
            'newOrders',
            'newCustomers',
            'newProducts'
        ));
    }
}