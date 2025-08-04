<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class ReviewController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $user = Auth::guard('user')->user();
        $product = Product::findOrFail($id);

        // Optional: prevent duplicate reviews by same user on same product
        $alreadyReviewed = Review::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->exists();

        if ($alreadyReviewed) {
            return back()->with('error', 'You have already reviewed this product.');
        }

        Review::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'rating' => $request->rating,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Thank you for your review!');
    }

}