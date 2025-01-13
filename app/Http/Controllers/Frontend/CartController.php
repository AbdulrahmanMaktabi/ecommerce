<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariantIem;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;


class CartController extends Controller
{

    public function __old_addToCart(Request $request)
    {
        // Find the product
        try {
            $product = Product::findOrFail($request->productID);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Product not found or an unexpected error occurred.'
            ], 404); // Return a 404 status code for "not found"
        }

        // Initialize variants and calculate total variant price
        $variants = [];
        $variantsTotalAmount = 0;
        $productTotalPrice = 0;

        // Prepare cart data
        $cartItem = [
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $productTotalPrice,
        ];

        try {
            if (isset($request->variants)) {
                foreach ($request->variants as $item_id) {
                    $variantItem = ProductVariantIem::findOrFail($item_id);
                    $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
                    $variants[$variantItem->productVariant->name]['price'] = $variantItem->price;
                    $variantsTotalAmount += $variantItem->price;
                }

                // Add variants to options if present
                $cartItem['options'] = [
                    'variants' => $variants,
                ];

                // Calculate the total price of the product (including variants)
                if (checkDiscount($product)) {
                    $productTotalPrice = ($product->offer_price * $request->qty) + $variantsTotalAmount;
                } else {
                    $productTotalPrice = ($product->price * $request->qty) + $variantsTotalAmount;
                }
            }
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Variants Error',
            ], 404);
        }


        // Calculate the total price of the product (including variants)
        if (checkDiscount($product)) {
            $productTotalPrice = ($product->offer_price * $request->qty);
        } else {
            $productTotalPrice = ($product->price * $request->qty);
        }

        try {
            // Add the item to the cart
            $rowId = Cart::add($cartItem);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Error While Adding Item To Cart',
            ], 404);
        }

        // return response()->json(['row_id' => $rowId->rowId], 200);
        if (isset($rowId)) {
            // Get the added cart item
            $addedItem = Cart::get($rowId->rowId);
        } else {
            return response()->json(['error' => 'The Cart No Have Any Item'], 404);
        }

        if ($addedItem) {
            // Return a JSON response with the cart item
            return response()->json([
                'success' => true,
                'message' => 'Item added to cart successfully!',
                'cartItem' => $addedItem,
            ]);
        }
    }

    // Optimized Version Of add To Cart() function
    public function addToCart(Request $request)
    {
        $request->validate([
            'productID' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'variants' => 'nullable|array',
            'variants.*' => 'required_with:variants|exists:product_variant_iems,id',
        ]);

        try {
            $product = Product::findOrFail($request->productID);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        $variants = [];
        $variantsTotalPrice = 0;

        if ($request->filled('variants')) {
            foreach ($request->variants as $variantItemId) {
                try {
                    $variantItem = ProductVariantIem::findOrFail($variantItemId);
                    $variants[$variantItem->productVariant->name] = [
                        'name' => $variantItem->name,
                        'price' => $variantItem->price,
                    ];
                    $variantsTotalPrice += $variantItem->price;
                } catch (\Throwable $th) {
                    return response()->json(['error' => 'Invalid variant selected.'], 422);
                }
            }
        }

        $productTotalPrice = $this->calculateProductPrice($product, $request->qty, $variantsTotalPrice);

        $cartItem = [
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $productTotalPrice,
            'options' => [
                'variants' => $variants,
            ],
        ];

        try {
            $rowId = Cart::add($cartItem);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error while adding item to cart.'], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart successfully!',
            'cartItem' => Cart::get($rowId->rowId),
        ]);
    }

    // Cart Page
    public function cart(Request $request)
    {
        $cart = Cart::content();
        return view('frontend.pages.cart', get_defined_vars());
    }

    private function calculateProductPrice($product, $qty, $variantsTotalPrice)
    {
        return checkDiscount($product)
            ? ($product->offer_price * $qty) + $variantsTotalPrice
            : ($product->price * $qty) + $variantsTotalPrice;
    }
}
