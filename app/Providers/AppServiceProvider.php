<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Cart;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.frontend', function ($view) {
            $categories = Category::with(['subcategories' => function ($query) {
                $query->orderBy('subcategory_name', 'ASC');
            }])
                ->whereIn('category_name', ['Men', 'Women', 'Kids', 'Accessories'])
                ->get();

            // Load Cart only for authenticated frontend user
            $cart = collect();
            if (Auth::guard('user')->check()) {
                $userId = Auth::guard('user')->id();
                $cart = Cart::where('user_id', $userId)->get();
            }

            $generalSetting = GeneralSetting::first();

            $view->with([
                'navbarCategories' => $categories,
                'cart' => $cart,
                'genSetting' => $generalSetting,
            ]);
        });
    }
}
