<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariantIem;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($slug)
    {
        $product = Product::status(1)
            ->with(['category', 'brand', 'vendor', 'imageGallery', 'variants'])
            ->where('slug', $slug)
            ->first();

        $subCategory = SubCategory::status(1)
            ->findOrFail($product->subCategory->id);

        return view('frontend.pages.product', get_defined_vars());
    }

    public function getVariantPrice(Request $request)
    {
        // Get the product
        $product = Product::findOrFail($request->product_id);

        // Get the selected variant item
        $variantItem = ProductVariantIem::findOrFail($request->variant_item_id);

        // Calculate the new price
        $newPrice = $product->price + ($variantItem ? $variantItem->price : 0);

        // Return the new price
        return response()->json([
            'newPrice' => $newPrice
        ]);
    }
}
