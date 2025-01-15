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
        try {
            $product = Product::status(1)
                ->with([
                    'category',
                    'brand',
                    'vendor',
                    'imageGallery',
                    'variants' => function ($query) {
                        $query->where('status', 1); // Only include active variants
                    }
                ])
                ->whereHas('category', function ($query) {
                    $query->where('status', 1); // Ensure the category is active
                })
                ->whereHas('brand', function ($query) {
                    $query->where('status', 1); // Ensure the brand is active
                })
                ->whereHas('vendor', function ($query) {
                    $query->where('status', 1); // Ensure the vendor is active
                })
                ->where('slug', $slug)
                ->first();

            if (!$product) {
                // If no product is found, return an error response or show a custom view
                return response()->json(['status' => 'error', 'message' => 'The product cannot be found.'], 404);
            }

            $subCategory = SubCategory::status(1)
                ->findOrFail($product->subCategory->id);

            return view('frontend.pages.product', compact('product', 'subCategory'));
        } catch (\Throwable $th) {

            return response()->json(['status' => 'error', 'message' => 'An unexpected error occurred.'], 500);
        }
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
