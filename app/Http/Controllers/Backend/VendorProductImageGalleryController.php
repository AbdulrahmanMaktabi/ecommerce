<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductImageGalleryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Traits\imageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductImageGalleryController extends Controller
{
    use imageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VendorProductImageGalleryDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);

        // check if is same vendor
        if ($product->vendor_id != Auth::user()->vendor->id) return abort(403);

        return $dataTable->render('vendor.products.image-gallery.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image.*' => ['required', 'image', 'max:2500'],
            'product' => ['required', 'exists:products,id']
        ]);

        $imagesPath = $this->uploadMultiImages($request, 'image', 'uploads', 'product');

        foreach ($imagesPath as $key => $path) {
            ProductImageGallery::create([
                'image' => $path,
                'product_id' => $request->product
            ]);
        }

        toastr('Product Image Gallery Created Successfully');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productImageGallery = ProductImageGallery::findOrFail($id);

        // check if is same vendor
        if ($productImageGallery->product->vendor_id != Auth::user()->vendor->id) return abort(403);

        $this->deleteImage($productImageGallery->image);

        $productImageGallery->delete();

        return response()->json('Product Image Gallery Deleted Succsessfully');
    }
}
