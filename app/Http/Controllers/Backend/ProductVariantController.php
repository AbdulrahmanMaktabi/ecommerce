<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductVariantDataTable $dataTable)
    {
        $prodcut = Product::findOrFail($request->product);
        return $dataTable->render('admin.product.variant.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'name' => ['required', 'unique:product_variants,name'],
            'status' => ['required', 'boolean']
        ]);

        $variant = ProductVariant::create($data);

        toastr('Variant Created Successfully');
        return to_route('admin.product.variant.index', ['product' => $data['product_id']]);
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
        $variant = ProductVariant::findOrFail($id);
        return view('admin.product.variant.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'name' => ['required', 'unique:product_variants,name'],
            'status' => ['required', 'boolean']
        ]);

        $variant = ProductVariant::findOrFail($id);

        $variant->update($data);

        toastr('Variant Updated Successfully');
        return to_route('admin.product.variant.index', ['product' => $data['product_id']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variant = ProductVariant::findOrFail($id);

        $variant->delete();

        toastr('Product Variant Deleted Successfully');
        return response('Deleted Successfully');
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
