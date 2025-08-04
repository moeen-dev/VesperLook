<?php

namespace App\Http\Controllers\Backend;

use App\Models\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Dimensions;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('id', 'ASC')->get();
        return view('backend.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048|mimes:jpeg,jpg,gif,png,webp|dimensions:width=1920,height=844',
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalName();
            $filename = time() . '-image-' . $extension;
            $file->move('upload/images/', $filename);
            $input['image'] = $filename;
        }

        Banner::create($input);

        return redirect()->route('banner.index')->with('success', 'New banner has been added successfully');
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
        $banner = Banner::findOrFail(intval($id));
        return view('backend.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $banner = Banner::findOrFail($id);

        if ($banner->id == $request->id) {
            $request->validate([
                'image' => 'required|image|max:2048|mimes:jpeg,jpg,gif,png,webp|dimensions:width=1920,height=844',
            ]);
        } else {
            $request->validate([
                'image' => 'nullable|image|max:2048|mimes:jpeg,jpg,gif,png,webp|dimensions:width=1920,height=844',
            ]);
        }

        $input = $request->all();

        if ($request->hasFile('image')) {
            if ($banner->image && file_exists(public_path('upload/images/' . $banner->image))) {
                unlink(public_path('upload/images/' . $banner->image));
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalName();
            $filename = time() . '-image-' . $extension;
            $file->move('upload/images/', $filename);
            $input['image'] = $filename;
        }

        $banner->update($input);

        return redirect()->route('banner.index')->with('success', 'Banner has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::findOrFail(intval($id));

        if ($banner->count() <= 3) {
            return redirect()->route('banner.index')->with('error', 'You cannot proceed with the action as there are 3 remaining banner left!');
        } else {
            $filename = $banner->image;
            $imagePath = public_path('upload/images/' . $filename);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $banner->delete();
        }

        return redirect()->route('banner.index')->with('success', 'Banner has been deleted Successfully.');
    }
}
