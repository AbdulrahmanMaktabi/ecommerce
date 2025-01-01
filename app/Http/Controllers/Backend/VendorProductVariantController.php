<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantDataTable;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class VendorProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VendorProductVariantDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);
        return $dataTable->render('vendor.products.variant.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.products.variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'status' => ['required', 'boolean'],
            'product_id' => ['required', 'exists:products,id']
        ]);

        $productVariant = ProductVariant::create($data);

        $product = Product::findOrFail($data['product_id']);

        toastr('Product Variant Created Successfully');
        return to_route('vendor.product-variant.index', get_defined_vars());
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
        $variant =  ProductVariant::findOrFail($id);

        return view('vendor.products.variant.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $productVariant = ProductVariant::findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
            'status' => ['required', 'boolean'],
            'product_id' => ['required', 'exists:products,id']
        ]);

        $productVariant->update($data);

        toastr('Product Variant Created Successfully');
        return to_route('vendor.product-variant.index', ['product' => $data['product_id']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productVariant = ProductVariant::findOrFail($id);

        $productVariant->delete();

        toastr('Product Variant Deleted Successfully');
        return response()->json(['status' => 'success', 'message' => 'Product Variant Deleted Successfully']);
    }

    /**
     * Update the specified resource status
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:product_variants,id',
            'status' => 'required|boolean'
        ]);

        $productVariant = ProductVariant::findOrFail($request->id);
        $productVariant->status = $request->status;
        $productVariant->save();
    }
}
