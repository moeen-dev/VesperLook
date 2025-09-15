<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('id', 'ASC')->get();
        return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|min:3|max:255|unique:categories',
            'slug' => 'required|unique:categories'
        ]);

        $input = $request->all();

        Category::create($input);

        return redirect()->route('category.index')->with('success', 'New category added successfully.');
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
        $category = Category::findOrFail(intval($id));

        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        if ($category->slug == $request->slug) {
            $request->validate([
                'category_name' => 'required|string|min:3|max:255',
                'slug' => 'required',
            ]);
        } else {
            $request->validate([
                'category_name' => 'required|string|min:3|max:255|unique:categories',
                'slug' => 'required',
            ]);
        }

        $input = $request->all();

        $category->update($input);

        return redirect()->route('category.index')->with('success', 'Category has been update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail(intval($id));

        if ($category->subcategories()->exists()) {
            return redirect()->route('category.index')->with('error', 'You cannot delete this category because it has associated subcategories.');
        }


        if ($category->count() <= 3) {
            return redirect()->route('category.index')->with('error', 'You cannot procces with the action as there are 3 reaming category left!');
        } else {
            $category->delete();
        }

        return redirect()->route('category.index')->with('success', 'Category has been deleted successfully.');
    }
}
