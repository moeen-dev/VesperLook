<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModalController extends Controller
{
    public function quickView($id)
    {
        // Fetch product with relationships (adjust as needed)
        $product = Product::find($id);
        $colors = array_filter($product->colors);

        // Return a partial Blade view to be rendered inside the modal
        return view('frontend.partials.quickview', compact('product', 'colors'));
    }
}
