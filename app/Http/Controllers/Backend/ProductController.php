<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\SubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::orderBy('id', 'ASC')->get();
        return view('backend.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subcategories = SubCategory::orderBy('subcategory_name', 'ASC')->get();
        return view('backend.product.create', compact('subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:products,slug',
            'sub_category_id' => 'required|integer',
            'price' => 'required|numeric',
            'sizes' => 'array',
            'colors' => 'array',
            'colors.*' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'description' => 'required',
            'image1' => 'required|image|min:3|max:2048|mimes:jpeg,jpg,gif,png',
            'image2' => 'required|image|min:3|max:2048|mimes:jpeg,jpg,gif,png',
            'image3' => 'required|image|min:3|max:2048|mimes:jpeg,jpg,gif,png',
            'image4' => 'required|image|min:3|max:2048|mimes:jpeg,jpg,gif,png',
            'is_new' => 'required|boolean',
            // 'sku' => 'required|unique:products,sku',
            'quantity' => 'required|integer|min:0',
        ]);

        $input = $request->all();

        // Handle Image Uploads for each field
        if ($request->hasFile('image1')) {
            $file = $request->file('image1');
            $extension = $file->getClientOriginalName();
            $filename = time() . '-image1-' . $extension;
            $file->move('upload/images/', $filename);
            $input['image1'] = $filename;
        }
        if ($request->hasFile('image2')) {
            $file = $request->file('image2');
            $extension = $file->getClientOriginalName();
            $filename = time() . '-image2-' . $extension;
            $file->move('upload/images/', $filename);
            $input['image2'] = $filename;
        }
        if ($request->hasFile('image3')) {
            $file = $request->file('image3');
            $extension = $file->getClientOriginalName();
            $filename = time() . '-image3-' . $extension;
            $file->move('upload/images/', $filename);
            $input['image3'] = $filename;
        }
        if ($request->hasFile('image4')) {
            $file = $request->file('image4');
            $extension = $file->getClientOriginalName();
            $filename = time() . '-image4-' . $extension;
            $file->move('upload/images/', $filename);
            $input['image4'] = $filename;
        }

        Product::create($input);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subcategories = SubCategory::orderBy('id', 'ASC')->get();
        $product = Product::findOrFail(intval($id));

        if (is_string($product->colors)) {
            $product->colors = json_decode($product->colors, true); // Decode if it's a string
        }

        return view('backend.product.edit', compact('subcategories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->slug == $request->slug) {
            $request->validate([
                'title' => 'required',
                'slug' => 'required',
                'sub_category_id' => 'required|integer',
                'price' => 'required|numeric',
                'sizes' => 'array',
                'colors' => 'nullable|array',
                'colors.*' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
                'description' => 'required',
                'image1' => 'nullable|image|min:3|max:2048|mimes:jpeg,jpg,gif,png',
                'image2' => 'nullable|image|min:3|max:2048|mimes:jpeg,jpg,gif,png',
                'image3' => 'nullable|image|min:3|max:2048|mimes:jpeg,jpg,gif,png',
                'image4' => 'nullable|image|min:3|max:2048|mimes:jpeg,jpg,gif,png',
                'is_new' => 'required|boolean',
                // 'sku' => 'required',
                'quantity' => 'required|integer|min:0',
            ]);
        } else {
            $request->validate([
                'title' => 'required',
                'slug' => 'required|unique:products,slug',
                'sub_category_id' => 'required|integer',
                'price' => 'required|numeric',
                'sizes' => 'array',
                'colors' => 'nullable|array',
                'colors.*' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
                'description' => 'required',
                'image1' => 'nullable|image|min:3|max:2048|mimes:jpeg,jpg,gif,png',
                'image2' => 'nullable|image|min:3|max:2048|mimes:jpeg,jpg,gif,png',
                'image3' => 'nullable|image|min:3|max:2048|mimes:jpeg,jpg,gif,png',
                'image4' => 'nullable|image|min:3|max:2048|mimes:jpeg,jpg,gif,png',
                // 'sku' => 'required',
                'quantity' => 'required|integer|min:0',
            ]);
        }

        $input = $request->all();

        $input['sizes'] = $request->has('sizes') ? $request->input('sizes') : [];
        $input['colors'] = $request->has('colors') ? $request->input('colors') : [];

        // Handle Image Uploads for each field
        if ($request->hasFile('image1')) {
            // Delete the old image if it exists
            if (isset($product->image1) && file_exists(public_path('upload/images/' . $product->image1))) {
                unlink(public_path('upload/images/' . $product->image1));
            }

            // Upload the new image
            $file = $request->file('image1');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '-image1.' . $extension;
            $file->move('upload/images/', $filename);
            $input['image1'] = $filename;
        }

        if ($request->hasFile('image2')) {
            // Delete the old image if it exists
            if (isset($product->image2) && file_exists(public_path('upload/images/' . $product->image2))) {
                unlink(public_path('upload/images/' . $product->image2));
            }

            // Upload the new image
            $file = $request->file('image2');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '-image2.' . $extension;
            $file->move('upload/images/', $filename);
            $input['image2'] = $filename;
        }

        if ($request->hasFile('image3')) {
            // Delete the old image if it exists
            if (isset($product->image3) && file_exists(public_path('upload/images/' . $product->image3))) {
                unlink(public_path('upload/images/' . $product->image3));
            }

            // Upload the new image
            $file = $request->file('image3');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '-image3.' . $extension;
            $file->move('upload/images/', $filename);
            $input['image3'] = $filename;
        }

        if ($request->hasFile('image4')) {
            // Delete the old image if it exists
            if (isset($product->image4) && file_exists(public_path('upload/images/' . $product->image4))) {
                unlink(public_path('upload/images/' . $product->image4));
            }

            // Upload the new image
            $file = $request->file('image4');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '-image4.' . $extension;
            $file->move('upload/images/', $filename);
            $input['image4'] = $filename;
        }


        $product->update($input);

        return redirect()->route('products.index')->with('success', 'Product has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail(intval($id));

        if ($product->count() <= 0) {
            return redirect()->route('products.index')->with('error', 'You cannot procces with the action as there are 3 reaming product left!');
        }

        $imageFields = ['image1', 'image2', 'image3', 'image4'];

        foreach ($imageFields as $imageField) {
            if (!empty($product->$imageField)) { // Check if image exists
                $imagePath = public_path('upload/images/' . $product->$imageField);
                if (file_exists($imagePath) && is_file($imagePath)) { // Ensure it's a file
                    unlink($imagePath);
                }
            }
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product has been deleted successfully.');
    }
}
