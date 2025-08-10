<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\SeoSetting;

class SeoSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $seoGenerals = SeoSetting::whereNull('reference_id')
            ->paginate(5, ['*'], 'general_page');

        $seoCollections = SeoSetting::where('page_type', 'collection')
            ->with('subCategory')
            ->paginate(5, ['*'], 'collection_page');

        $seoProducts = SeoSetting::where('page_type', 'product')
            ->with('product')
            ->paginate(5, ['*'], 'product_page');


        $subCategories = SubCategory::select('id', 'subcategory_name')->get();
        $products = Product::select('id', 'title')->get();

        return view('backend.settings.seo.index', compact('seoGenerals', 'products', 'subCategories',  'seoCollections', 'seoProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subCategories = SubCategory::select('id', 'subcategory_name')->get();
        $products = Product::select('id', 'title')->get();

        $seoCollectionIds = SeoSetting::where('page_type', 'collection')->pluck('reference_id')->toArray();
        $seoProductIds = SeoSetting::where('page_type', 'product')->pluck('reference_id')->toArray();

        return view('backend.settings.seo.create', compact('subCategories', 'products', 'seoCollectionIds', 'seoProductIds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'page_type' => 'required|string|max:255',
            'reference_id' => [
                'nullable',
                'integer',
                Rule::unique('seo_settings')->where(function ($query) use ($request) {
                    return $query->where('page_type', $request->page_type);
                }),
            ],
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'meta_keywords' => 'required|string|max:255',
        ]);

        $input = $request->all();

        SeoSetting::create($input);

        return redirect()->route('admin.setting.seo.index')->with('success', 'SEO settings saved successfully.');

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
        // SubCategories and Products
        $subCategories = SubCategory::select('id', 'subcategory_name')->get();
        $products = Product::select('id', 'title')->get();

        $seoCollectionIds = SeoSetting::where('page_type', 'collection')->pluck('reference_id')->toArray();
        $seoProductIds = SeoSetting::where('page_type', 'product')->pluck('reference_id')->toArray();

        $seoSetting = SeoSetting::findOrFail(intval($id));
        return view('backend.settings.seo.edit', compact('seoSetting', 'subCategories', 'products', 'seoCollectionIds', 'seoProductIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $seoSetting = SeoSetting::findOrFail(intval($id));

        $request->validate([
            'page_type' => 'required|string|max:255',
            'reference_id' => [
                'nullable',
                'integer',
                Rule::unique('seo_settings')
                    ->where(function ($query) use ($request) {
                        return $query->where('page_type', $request->page_type);
                    })
                    ->ignore($seoSetting->id),
            ],
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'meta_keywords' => 'required|string|max:255',
        ]);

        $seoSetting->update($request->all());

        return redirect()->route('admin.setting.seo.index')->with('success', 'SEO settings updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
