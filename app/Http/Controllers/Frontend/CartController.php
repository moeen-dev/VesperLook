<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    // Show cart page
    public function index()
    {
        $user = Auth::guard('user')->user();
        $carts = Cart::where('user_id', $user->id)->get();

        return view('frontend.cart.index', compact('carts'));
    }

    // Add Cart Page
    public function addToCart(Request $request, $id)
    {
        // Check User Login
        if (!Auth::guard('user')->check()) {
            return redirect()->route('user.login');
        }

        $user = Auth::guard('user')->user();
        $product = Product::findOrFail($id);

        $colors = collect($product->colors)->filter()->all();
        $sizes = collect($product->sizes)->filter()->all();

        $rules = [
            'quantity' => 'nullable|integer|min:1',
        ];

        if (count($colors) > 0) {
            $rules['color'] = 'required|string|in:' . implode(',', $colors);
        }

        if (count($sizes) > 0) {
            $rules['size'] = 'required|string|in:' . implode(',', $sizes);
        }

        $customMessages = [
            'color.required' => 'Please select a color.',
            'color.in' => 'Selected color is not available.',
            'size.required' => 'Please select a size.',
            'size.in' => 'Selected size is not available.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', $validator->errors()->first());
        }

        $quantity = $request->input('quantity', 1);

        $totalPrice = $product->price * $quantity;
        $existingCartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->where('color', $request->color)
            ->where('size', $request->size)
            ->first();

        if ($existingCartItem) {
            $existingCartItem->quantity += $quantity;
            $existingCartItem->price += $totalPrice;
            $existingCartItem->save();
        } else {
            Cart::create([
                'name' => $user->name,
                'title' => $product->title,
                'image' => $product->image1,
                'price' => $totalPrice,
                'quantity' => $quantity,
                'size' => $request->size,
                'color' => $request->color,
                'product_id' => $product->id,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }
}
