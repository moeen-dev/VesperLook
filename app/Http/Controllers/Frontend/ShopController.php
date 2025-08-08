<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $subCategories = SubCategory::withCount('products')->inRandomOrder()->get();

        $query = Product::query(); // Initialize query

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
                case 'category_men': // Filter products where category name is "Men"
                    $query->whereHas('subCategory.category', function ($query) {
                        $query->where('category_name', 'Men'); // Filter by the category name "Men"
                    })
                        ->orderBy('products.id', 'DESC');
                    break;

                case 'category_women': // Filter products where category name is "Women"
                    $query->whereHas('subCategory.category', function ($query) {
                        $query->where('category_name', 'Women'); // Filter by the category name "Women"
                    })
                        ->orderBy('products.id', 'DESC');
                    break;

                case 'category_kid': // Filter products where category name is "Kids"
                    $query->whereHas('subCategory.category', function ($query) {
                        $query->where('category_name', 'Kids'); // Filter by the category name "Kids"
                    })
                        ->orderBy('products.id', 'DESC');
                    break;

                case 'category_accessories': // Filter products where category name is "Accessories"
                    $query->whereHas('subCategory.category', function ($query) {
                        $query->where('category_name', 'Accessories'); // Filter by the category name "Accessories"
                    })
                        ->orderBy('products.id', 'DESC');
                    break;

                default:
                    $query->orderBy('id', 'DESC');
                    break;
            }
        } else {
            $query->orderBy('id', 'DESC'); // Apply random order when no sorting is selected
        }

        $products = $query->paginate(9); // Fetch products with applied order

        $seo = getSeo('product');

        $bestSellers = Product::with(['category', 'subcategory'])
            ->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->take(4)
            ->get();


        return view('frontend.shop.index', compact('products', 'subCategories', 'seo', 'bestSellers'));
    }

    // Single products showing
    public function showDetails($categorySlug, $subcategorySlug, $productSlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $subcategory = SubCategory::where('slug', $subcategorySlug)->firstOrFail();
        $product = Product::where('slug', $productSlug)->firstOrFail();

        $reviews = Review::where('product_id', $product->id)->latest()->get();
        $averageRating = Review::where('product_id', $product->id)->avg('rating');

        $colors = array_filter($product->colors);
        $user = Auth::guard('user')->user();

        $seo = getSeo('product', $product->id);

        return view('frontend.shop.details', compact(
            'category',
            'subcategory',
            'product',
            'reviews',
            'averageRating',
            'colors',
            'user',
            'seo'
        ));
    }
}
