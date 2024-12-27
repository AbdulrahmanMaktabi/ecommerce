<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\SubCategory;
use App\Models\Vendor;
use App\Traits\imageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;

use function PHPUnit\Framework\isNull;

class ProductController extends Controller
{
    use imageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::status(1)->get();
        $subCategories = SubCategory::status(1)->get();
        $childCategories = ChildCategory::status(1)->get();
        $brands = Brand::status(1)->get();
        $vendors = Vendor::status(1)->get();

        return view('admin.product.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
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
            "thumb_image" => "required|image|max:255",
        ]);

        $thumb_image = $this->uploadImage($request, 'thumb_image');
        $data['thumb_image'] = $thumb_image;

        $data['slug'] = Str::slug($data['name']);

        Product::create($data);

        toastr('Product Created Successfully');
        return redirect()->back();
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
        $product = Product::findOrFail($id);

        $categories = Category::status(1)->get();
        $subCategories = SubCategory::status(1)->get();
        $childCategories = ChildCategory::status(1)->get();
        $brands = Brand::status(1)->get();
        $vendors = Vendor::status(1)->get();

        return view('admin.product.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

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
            "category_id" => "nullable|exists:categories,id",
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
            "thumb_image" => "nullable|image|max:255",
        ]);

        if ($request->hasFile('thumb_image')) {
            $thumb_image = $this->updateImage($request, 'thumb_image');
            $data['thumb_image'] = $thumb_image;
        } else {
            unset($data['thumb_image']);
        }

        $data['slug'] = Str::slug($data['name']);

        $product->update($data);

        toastr('Product Updated Successfully');
        return to_route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $this->deleteImage($product->thumb_image);

        $galleryImage = ProductImageGallery::where('product_id', $product->id);
        foreach ($galleryImage as $image) {
            $this->deleteImage($image->image);
        }

        $product->delete();

        toastr('Product Deleted Successfully');

        return response()->json(['status' => 'success', 'message' => 'Product Deleted Successfully']);
    }

    /**
     * Update the specified resource status
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'slug' => 'required|exists:products,slug',
            'status' => 'required|boolean'
        ]);

        $product = Product::where('slug', $request->slug)->firstOrFail();
        $product->status = $request->status;
        $product->save();
    }

    /**
     * Get All Sub Categories By Category 
     */
    public function subCategories($category_id): JsonResponse
    {
        // Find the category by ID and ensure it is active
        $category = Category::status(1)->find($category_id);

        if (!$category) {
            return response()->json([
                'message' => 'Category not found or inactive.',
            ], 404);
        }

        // Retrieve subcategories
        $subCategories = $category->subCategories;

        if ($subCategories->isNotEmpty()) {
            return response()->json($subCategories, 200);
        }

        return response()->json([
            'message' => 'No subcategories available for this category.',
        ], 404);
    }

    /**
     * Get All Child Categories By Sub Category 
     */
    public function childCategories($subCategory_id): JsonResponse
    {
        // Find the subcategory by ID and ensure it is active
        $subCategory = SubCategory::status(1)->find($subCategory_id);

        if (!$subCategory) {
            return response()->json([
                'message' => 'Subcategory not found or inactive.',
            ], 404);
        }

        // Retrieve child categories
        $childCategories = $subCategory->childCategories;

        if ($childCategories->isNotEmpty()) {
            return response()->json($childCategories, 200);
        }

        return response()->json([
            'message' => 'No child categories available for this subcategory.',
        ], 404);
    }
}
