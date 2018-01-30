<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Order;

class DashboardController extends Controller
{
    public function index() {
        return view('admin.dashboard.index',[
            'directory' => 'dashboard',
            'categories_count' => Category::all()->count(),
            'products_count' => Product::all()->count(),
            'orders_count' => Order::all()->count(),
        ]);
    }
}
