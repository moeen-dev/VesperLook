<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subcategories = SubCategory::orderBy('id', 'ASC')->get();
        return view('backend.subcategory.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'ASC')->get();
        return view('backend.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subcategory_name' => 'required|string|min:3|max:255|unique:sub_categories',
            'slug' => 'required|unique:sub_categories',
            'category_id' => 'required',
            'image' => 'required|image|max:2048|mimes:jpeg,jpg,gif,png,webp|dimensions:width=900,height=500',
        ]);


        $input = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalName();
            $filename = time() . '-image-' . $extension;
            $file->move('upload/images/', $filename);
            $input['image'] = $filename;
        }

        SubCategory::create($input);

        return redirect()->route('sub-category.index')->with('success', 'Subcategory has been created successfully.');
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
        $categories = Category::orderBy('id', 'ASC')->get();
        $subcategory = SubCategory::findOrFail(intval($id));
        return view('backend.subcategory.edit', compact('categories', 'subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subcategory = SubCategory::findOrFail($id);

        if ($subcategory->slug == $request->slug) {
            $request->validate([
                'subcategory_name' => 'required|string|min:3|max:255',
                'slug' => 'required',
                'category_id' => 'required',
                'image' => 'nullable|image|max:2048|mimes:jpeg,jpg,gif,png,webp|dimensions:width=900,height=500',
            ]);
        } else {
            $request->validate([
                'subcategory_name' => 'required|string|min:3|max:255|unique:sub_categories',
                'slug' => 'required|unique:sub_categories',
                'category_id' => 'required',
                'image' => 'nullable|image|max:2048|mimes:jpeg,jpg,gif,png,webp|dimensions:width=900,height=500',
            ]);
        }

        $input = $request->all();

        if ($request->hasFile('image')) {
            if ($subcategory->image && file_exists(public_path('upload/images/' . $subcategory->image))) {
                unlink(public_path('upload/images/' . $subcategory->image));
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalName();
            $filename = time() . '-image-' . $extension;
            $file->move('upload/images/', $filename);
            $input['image'] = $filename;
        }

        $subcategory->update($input);

        return redirect()->route('sub-category.index')->with('success', 'Sub Category has been update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = SubCategory::findOrFail(intval($id));

        if ($subcategory->products()->exists()) {
            return redirect()->route('sub-category.index')->with('error', 'This subcategory is still associated with categories and can not be deleted!');
        }

        if ($subcategory->count() <= 3) {
            return redirect()->route('sub-category.index')->with('error', 'You cannot procces with the action as there are 3 reaming category left!');
        } else {
            $filename = $subcategory->image;
            $imagePath = public_path('upload/images' . $filename);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $subcategory->delete();
        }

        return redirect()->route('sub-category.index')->with('success', 'Sub Category has been deleted successfully.');
    }
}
