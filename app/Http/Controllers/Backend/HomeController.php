<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->take(5)->get();
        // For total Admin 
        $totalAdmins = User::where('is_admin', 1)->count();
        // For total User
        $totalUsers = User::where('is_online', 1)->count();

        // For total Category and SubCategory
        $totalSubCategories = SubCategory::count();
        // For total Product
        $totalProducts = Product::where('quantity', '>', 0)->count();

        // For Orders
        $totalOrders = Order::count();
        // For Canceled
        $totalCanceled = Order::where('delivery_status', 'canceled')->count();

        $counts = Order::groupBy('delivery_status')->pluck(DB::raw('count(*)'), 'delivery_status');

        // Total selling 
        $totalAmount = Order::sum('total');
        $deliveredAmount = Order::where('payment_method', 'cod')
            ->where('delivery_status', 'delivered')
            ->sum('total');

        $totalDue = $totalAmount - $deliveredAmount;

        // Today's Sales
        $todaysSales = Order::whereDate('created_at', today())->sum('total');
        $yesterdaySales = Order::whereDate('created_at', today()->subDay())->sum('total');
        $todaysSalesChange = $yesterdaySales > 0 ? (($todaysSales - $yesterdaySales) / $yesterdaySales) * 100 : 0;

        // This Week's Sales
        $thisWeeksSales = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('total');
        $lastWeeksSales = Order::whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])->sum('total');
        $thisWeeksSalesChange = $lastWeeksSales > 0 ? (($thisWeeksSales - $lastWeeksSales) / $lastWeeksSales) * 100 : 0;

        // This Month's Sales
        $thisMonthsSales = Order::whereMonth('created_at', now()->month)->sum('total');
        $lastMonthsSales = Order::whereMonth('created_at', now()->subMonth()->month)->sum('total');
        $thisMonthsSalesChange = $lastMonthsSales > 0 ? (($thisMonthsSales - $lastMonthsSales) / $lastMonthsSales) * 100 : 0;

        // This Year's Sales
        $thisYearsSales = Order::whereYear('created_at', now()->year)->sum('total');
        $lastYearsSales = Order::whereYear('created_at', now()->subYear()->year)->sum('total');
        $thisYearsSalesChange = $lastYearsSales > 0 ? (($thisYearsSales - $lastYearsSales) / $lastYearsSales) * 100 : 0;

        $dailySales = [];
        $weekDays = [];

        for ($i = 0; $i < 7; $i++) {
            $day = Carbon::now()->startOfWeek()->addDays($i);
            $weekDays[] = $day->format('l');
            $sales = Order::whereDate('created_at', $day)->sum('total');
            $dailySales[] = $sales;
        }

        return view('backend.home.index', compact(
            'orders',
            'totalAdmins',
            'totalUsers',
            'totalProducts',
            'totalSubCategories',
            'totalOrders',
            'totalCanceled',
            'counts',
            'totalAmount',
            'totalDue',
            'todaysSales',
            'todaysSalesChange',
            'thisWeeksSales',
            'thisWeeksSalesChange',
            'thisMonthsSales',
            'thisMonthsSalesChange',
            'thisYearsSales',
            'thisYearsSalesChange',
            'dailySales',
            'weekDays'
        ));
    }
}
