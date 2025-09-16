<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    // Show collection page
    public function index()
    {
        $categories = Category::whereIn('category_name', ['Men', 'Women', 'Kids', 'Accessories'])->get();
        $subCategories = SubCategory::withCount('products')->orderBy('id', 'DESC')->get();

        $seo = getSeo('collection');
        return view('frontend.collection.index', compact('subCategories', 'categories', 'seo'));
    }

    // Show collection page products
    public function show($categorySlug, $subcategorySlug, Request $request)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $subcategory = SubCategory::where('slug', $subcategorySlug)->firstOrFail();
        $subCategories = SubCategory::withCount('products')->inRandomOrder()->get();

        $query = $subcategory->products();

        // Apply sorting if a sort parameter exists
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'low_to_high':
                    $query->orderBy('price', 'ASC');
                    break;
                case 'high_to_low':
                    $query->orderBy('price', 'DESC');
                    break;
                case 'latest':
                    $query->orderBy('created_at', 'DESC');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'ASC');
                    break;
                default:
                    $query->orderBy('id', 'DESC');
                    break;
            }
        } else {
            $query->orderBy('id', 'DESC');
        }

        $products = $query->paginate(9);

        $seo = getSeo('collection', $subcategory->id);

        $bestSellers = Product::with(['category', 'subcategory'])
            ->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->take(4)
            ->get();

        return view('frontend.shop.index', compact('category', 'subcategory', 'products', 'subCategories', 'seo', 'bestSellers'));
    }
}
