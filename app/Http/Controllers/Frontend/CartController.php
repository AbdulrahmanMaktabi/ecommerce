<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariantIem;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;


class CartController extends Controller
{

    public function addToCart(Request $request)
    {
        // Find the product
        $product = Product::findOrFail($request->productID);

        // Initialize variants and calculate total variant price
        $variants = [];
        $variantsTotalAmount = 0;

        if (isset($request->variants)) {
            foreach ($request->variants as $item_id) {
                $variantItem = ProductVariantIem::findOrFail($item_id);
                $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
                $variants[$variantItem->productVariant->name]['price'] = $variantItem->price;
                $variantsTotalAmount += $variantItem->price;
            }
        }

        // Calculate the total price of the product (including variants)
        $productTotalPrice = 0;
        if (checkDiscount($product)) {
            $productTotalPrice = ($product->offer_price * $request->qty) + $variantsTotalAmount;
        } else {
            $productTotalPrice = ($product->price * $request->qty) + $variantsTotalAmount;
        }

        // Prepare cart data
        $cartItem = [
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $productTotalPrice,
        ];

        // Add variants to options if present
        if (isset($request->variants)) {
            $cartItem['options'] = [
                'variants' => $variants,
            ];
        }

        // Add the item to the cart
        $rowId = Cart::add($cartItem);

        // Get the added cart item
        $addedItem = Cart::get($rowId);

        // Return a JSON response with the cart item
        return response()->json([
            'success' => true,
            'message' => 'Item added to cart successfully!',
            'cartItem' => $addedItem,
        ]);
    }
}
