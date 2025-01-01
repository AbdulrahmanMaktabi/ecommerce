<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Traits\imageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use function Laravel\Prompts\error;

class VendorProductController extends Controller
{
    use imageUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VendorProductDataTable $datatable)
    {
        return $datatable->render('vendor.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::status(1)->get();
        $categories = Category::status(1)->get();

        return view('vendor.products.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string|max:255",
            "qty" => "required|integer|min:0",
            "price" => "required|numeric|min:0",
            "offer_price" => "nullable|numeric|min:0|lte:price",
            "short_description" => "required|string|max:255",
            "long_description" => "required|string",
            "offer_start_date" => "nullable|date|before_or_equal:offer_end_date",
            "offer_end_date" => "nullable|date|after_or_equal:offer_start_date",
            "vendor_id" => "required|exists:vendors,id",
            "brand_id" => "required|exists:brands,id",
            "status" => "required|boolean",
            "category_id" => "required|exists:categories,id",
            "subCategory_id" => "nullable|exists:sub_categories,id",
            "childCategory_id" => "nullable|exists:child_categories,id",
            "is_top" => "boolean",
            "is_best" => "boolean",
            "is_featured" => "boolean",
            "is_approved" => "boolean",
            "sku" => "nullable|string|max:100",
            "video_link" => "nullable|url",
            "seo_title" => "nullable|string|max:255",
            "seo_description" => "nullable|string",
            "thumb_image" => "required|image",
        ]);

        $thumb_image = $this->uploadImage($request, 'thumb_image');
        $data['thumb_image'] = $thumb_image;

        $data['slug'] = Str::slug($data['name']);

        Product::create($data);

        toastr('Product Created Successfully');
        return to_route('vendor.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Show a specific resource
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        if (Auth::user()->vendor->id != $product->vendor->id) return abort(403);

        $brands = Brand::status(1)->get();
        $categories = Category::status(1)->get();

        return view('vendor.products.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            "name" => "required|string|max:255",
            "qty" => "required|integer|min:0",
            "price" => "required|numeric|min:0",
            "offer_price" => "nullable|numeric|min:0|lte:price",
            "short_description" => "required|string|max:255",
            "long_description" => "required|string",
            "offer_start_date" => "nullable|date|before_or_equal:offer_end_date",
            "offer_end_date" => "nullable|date|after_or_equal:offer_start_date",
            "vendor_id" => "required|exists:vendors,id",
            "brand_id" => "required|exists:brands,id",
            "status" => "required|boolean",
            "category_id" => "required|exists:categories,id",
            "subCategory_id" => "nullable|exists:sub_categories,id",
            "childCategory_id" => "nullable|exists:child_categories,id",
            "is_top" => "boolean",
            "is_best" => "boolean",
            "is_featured" => "boolean",
            "is_approved" => "boolean",
            "sku" => "nullable|string|max:100",
            "video_link" => "nullable|url",
            "seo_title" => "nullable|string|max:255",
            "seo_description" => "nullable|string",
            "thumb_image" => "nullable|image",
        ]);

        if ($request->hasFile('thumb_image')) {
            $thumb_image = $this->updateImage($request, 'thumb_image');
            unset($data['thumb_image']);
            $data['thumb_image'] = $thumb_image;
        }

        $data['slug'] = Str::slug($data['name']);

        Product::findOrFail($id)->update($data);

        toastr('Product Update Successfully');
        return to_route('vendor.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete the resource from the database
    }

    public function subCategories($categoryID)
    {
        $category = Category::findOrFail($categoryID);

        $subCatoriges = $category->subCategories;

        if (count($subCatoriges) > 0) {
            return response()->json($subCatoriges);
        }

        return response('No Sub Categories Found');
    }

    public function childCategories($subCatoryID)
    {
        $subCatory = SubCategory::findOrFail($subCatoryID);

        $childCategories = $subCatory->childCategories;

        if (count($childCategories) > 0) {
            return response()->json($childCategories);
        }

        return response('No Child Categories Found');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'slug' => 'required|exists:products,slug',
            'status' => 'required|boolean'
        ]);

        $product = Product::where('slug', $request->slug)->first();
        if (!$product) return response('No Product Fount');
        $product->status = $request->status;
        $product->save();
    }
}
