<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Banner;
use App\Models\SubCategory;
use App\Models\Product;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('id', 'ASC')->get();
        $subCategories = SubCategory::inRandomOrder()->get();
        $products = Product::with('subCategory')->orderBy('created_at', 'desc')->get();

        $seo = getSeo('home');

        return view('frontend.home.index', compact('banners', 'subCategories', 'products', 'seo'));
    }
}
