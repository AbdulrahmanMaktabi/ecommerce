<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantItemsDataTable;
use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use App\Models\ProductVariantIem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductVariantItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductVariantItemsDataTable $datatable, $variant_id)
    {
        $variant = ProductVariant::findOrFail($variant_id);

        if ($variant->product->vendor_id != Auth::user()->vendor->id) return abort(403);

        return $datatable->render('vendor.products.variant-items.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($variant_id)
    {
        $variant = ProductVariant::findOrFail($variant_id);
        return view('vendor.products.variant-items.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => ['required'],
            "price" => ['nullable'],
            "product_variant_id" => ['required', 'exists:product_variants,id'],
            "is_default" => ['required'],
            "status" => ['required'],
        ]);
        $variant = ProductVariant::findOrFail($data['product_variant_id']);

        ProductVariantIem::create($data);
        toastr($data['name'] . " Item Created Successfully");

        return to_route('vendor.variant.items.index', ['product_id' => $variant->product_id, 'variant_id' => $variant->id]);
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
    public function edit($variant_id, $variant_item_id)
    {
        $item = ProductVariantIem::findOrFail($variant_item_id);
        $variant = ProductVariant::findOrFail($variant_id);

        if ($variant->product->vendor_id != Auth::user()->vendor->id) return abort(403);

        return view('vendor.products.variant-items.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $variant_id, $variant_item_id)
    {

        $variant = ProductVariant::findOrFail($variant_id);
        $item = ProductVariantIem::findOrFail($variant_item_id);

        if ($variant->product->vendor_id != Auth::user()->vendor->id) return abort(403);

        $data = $request->validate([
            "name" => ['required'],
            "price" => ['nullable'],
            "product_variant_id" => ['required', 'exists:product_variants,id'],
            "is_default" => ['required'],
            "status" => ['required'],
        ]);

        $item->update($data);

        toastr($data['name'] . " Item Created Successfully");

        return to_route('vendor.variant.items.index', ['product_id' => $variant->product_id, 'variant_id' => $variant->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($variant_id, $variant_item_id)
    {
        $item = ProductVariantIem::findOrFail($variant_item_id);

        if ($item->productVariant->product->vendor_id != Auth::user()->vendor->id) return abort(403);

        $item->delete();

        return response()->json(['status' => 'success', 'message' => 'Item Deleted Successfully']);
    }

    /**
     * Update Status
     */
    public function updateStatus(Request $request)
    {
        $data = $request->validate([
            'id' => ['required', 'exists:product_variant_iems,id'],
            'status' => ['required']
        ]);

        $item = ProductVariantIem::findOrFail($data['id']);

        $item->status = $data['status'];
        $item->save();
    }
}
