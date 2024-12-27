<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantIemDataTable;
use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use App\Models\ProductVariantIem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ProductVariantItemsController extends Controller
{
    public function index(ProductVariantIemDataTable $datatable, Request $request, $product_id, $variant_id)
    {
        $variant = ProductVariant::findOrFail($variant_id);

        return $datatable->render('admin.product.variant-items.index', get_defined_vars());
    }

    public function create(Request $request, $variant_id)
    {
        $variant = ProductVariant::findOrFail($variant_id);
        return view('admin.product.variant-items.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'product_variant_id' => ['required', 'exists:product_variants,id'],
            'price' => ['required'],
            'is_default' => ['required', 'boolean'],
            'status' => ['required', 'boolean'],
        ]);

        $variantItem = ProductVariantIem::create($data);

        toastr('Item Created Successfully');
        return redirect()->back();
    }

    public function edit(Request $request, $variant_id, $variant_item_id)
    {
        $variant = ProductVariant::findOrFail($variant_id);
        $variant_item = ProductVariantIem::findOrFail($variant_item_id);

        return view('admin.product.variant-items.edit', get_defined_vars());
    }

    public function update(Request $request, $variant_id, $variant_item_id)
    {
        $variant = ProductVariant::findOrFail($variant_id);
        $variant_item = ProductVariantIem::findOrFail($variant_item_id);

        $data = $request->validate([
            'name' => ['required'],
            // 'product_variant_id' => [
            //     'required',
            //     Rule::exists('product_variants', 'id')->where(function ($query) use ($variant) {
            //         $query->where('id', $variant->id);
            //     }),
            // ],
            'product_variant_id' => ['required', 'exists:product_variants,id'],
            'price' => ['required'],
            'is_default' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
        ]);

        $variant_item->update($data);
        toastr('Item Updated Successfully');

        return to_route('admin.variant.items.index', ['product_id' => $variant->Product->id, 'variant_id' => $variant->id]);
    }

    public function destroy($variant_id, $variant_item_id)
    {
        $variant = ProductVariant::findOrFail($variant_id);
        $variant_item = ProductVariantIem::findOrFail($variant_item_id);


        $variant_item->delete();
        toastr('Variant Item deleted successfully.');
        return response()->json('Variant Item deleted successfully');
    }

    /**
     * Update the specified resource status
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:product_variant_iems,id',
            'status' => 'required|boolean'
        ]);

        $productVariantItem = ProductVariantIem::findOrFail($request->id);
        $productVariantItem->status = $request->status;
        $productVariantItem->save();
    }
}
