<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\FlashSaleItem;
use App\Models\ProductVariantIem;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isNull;

class CartController extends Controller
{
    public function test()
    {
        return response()->json(['content' => Cart::content()]);
    }
    // Optimized Version Of add To Cart() function
    public function addToCart(Request $request)
    {
        $request->validate([
            'productID' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'variants' => 'nullable|array',
            'variants.*' => 'required_with:variants|exists:product_variant_iems,id',
            'flashSale_discount' => 'nullable|numeric|min:1',
        ]);

        try {
            $product = Product::findOrFail($request->productID);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        if (!$this->checkkQty($product, $request->qty)) {
            return response()->json(['error' => 'Product qty can not be greater then qty.'], 404);
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

        $productPrice = $this->calculateProductPrice($product, $request->qty);

        try {
            $flashSaleItem = FlashSaleItem::firstWhere('product_id', $request->productID);
            $flashSaleDiscount = $flashSaleItem ? $flashSaleItem->discounted_price : null;
        } catch (\Throwable $th) {
            return response()->json(['error' => 'An error occurred while retrieving the Flash Sale Item'], 422);
        }


        $cartItem = [
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $productPrice,
            'options' => [
                'variants' => $variants,
                'thumb_image' => $product->thumb_image,
                'slug' => $product->slug,
                'variantsTotalPrice' => $variantsTotalPrice,
            ],
        ];

        // Apply flash sale discount on product
        if ($flashSaleDiscount) {
            $cartItem['options']['flashSale_discount'] = $flashSaleDiscount;
        }

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

    // Destroy Cart
    public function destroy()
    {
        Cart::destroy();

        if (Session::has('checkout')) {
            Session::forget('checkout');
        }

        if (Session::has('cart')) {
            Session::forget('cart');
        }
        return redirect()->back();
    }

    // Delete Item in cart
    public function delete($rowId)
    {
        try {
            Cart::remove($rowId);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid rowId',
                'rowId' => $rowId,
            ]);
        }
        return redirect()->back();
    }

    // update qty
    public function updateQty(Request $request)
    {
        $request->validate([
            'rowId' => 'required|string', // Ensure rowId is a valid string
            'qty' => 'required|integer|min:1', // Ensure qty is an integer and at least 1
        ]);

        try {
            Cart::update($request->rowId, $request->qty);

            // Optionally, retrieve updated cart details
            $cartItem = Cart::get($request->rowId);

            $updatedPrice = getProductPriceTotal($request->rowId, $request->qty);
            // $updatedPrice = $this->calculateProductPrice($product, $request->qty, $cartItem->options->variantsTotalPrice);

            return response()->json([
                'status' => 'success',
                'message' => 'Updated Successfully',
                'cartItem' => $cartItem, // Include updated cart item
                'total' => Cart::total(), // Include updated cart total
                'updatedPrice' => $updatedPrice, // Send updated price
                'rowId' => $request->rowId // Return rowId to identify the correct item
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Data',
                'error' => $th->getMessage(), // Optional: Include exception message
            ]);
        }
    }

    public function subTotal()
    {
        return response()->json(
            ['status'  => 'success', 'data' => getSubTotalCartAmount()]
        );
    }

    // Coupon Logic
    public function coupon(Request $request)
    {
        $request->validate([
            'coupon' => ['required', 'exists:coupons,code'],
            'userId' => ['required', 'exists:users,id']
        ]);


        // Validate Coupon First
        $result = Coupon::validateCoupon($request->coupon, $request->userId);

        // Checking the resulet of validation
        if (!$result['status']) {
            return response()->json([
                'status' => 'error',
                'message' => $result['message'],
            ], 400);
        }

        // update the db
        CouponUsage::updateOrCreate(
            ['user_id' => $request->userId, 'coupon_id' => $result['coupon']->id],
            ['uses' => DB::raw('uses + 1')] // count 1 on uses column
        );

        // Session
        Session::put('coupon', $result['coupon']);

        // return success response
        return response()->json([
            'status' => 'success',
            'message' => $result['message'],
            'coupon' => $result['coupon'],
        ]);
    }

    // Calculate Total
    public function calculateTotal()
    {
        $subtotal = (float) str_replace(',', '', Cart::subtotal(2, '.', ','));
        $tax = (float) str_replace(',', '', Cart::tax(2, '.', ','));

        // Calculate the discount using the coupon function
        $discount = $this->calculateCouponDiscount();

        // Calculate the final total
        $final = $subtotal - $discount;
        // $finalTotal = $finalSubtotal + $tax; // Add tax back to the discounted subtotal

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'subtotal' => $subtotal,
            'tax' => $tax,
            'discount' => $discount,
            'total' => $final,
        ]);
    }

    // Count of items in cart
    public function count()
    {
        return Cart::count() ?? 0;
    }

    // Calculate sub total
    private function calculateProductPrice($product, $qty, $variantsTotalPrice = null)
    {
        if (isNull($variantsTotalPrice)) {
            return checkDiscount($product)
                ? ($product->offer_price + $variantsTotalPrice) * $qty
                : ($product->price + $variantsTotalPrice) * $qty;
        }
        return checkDiscount($product)
            ? ($product->offer_price * $qty)
            : ($product->price * $qty);
    }

    // Calculate Coupon discount    
    private function calculateCouponDiscount()
    {
        $subtotal = getSubTotalCartAmount();

        // Check if a coupon is applied
        $coupon = Session::get('coupon');

        if (!$coupon) {
            return 0; // No discount if no coupon is applied
        }

        // return $appliedCoupon->status;
        if (!$coupon || $coupon->status == 0) {
            Session::forget('applied_coupon'); // Clear invalid or inactive coupon from session
            return 0; // No discount for invalid coupon
        }

        if ($coupon->discount_type == 'amount') {
            $discount = $coupon->discount_amount; // Flat discount
        } elseif ($coupon->discount_type == 'percentage') {
            $discount = $subtotal * ($coupon->discount_amount / 100); // Percentage discount
        } else {
            $discount = 0;
        }

        // Ensure discount does not exceed the subtotal        
        return min($discount, $subtotal);
    }

    // Check Quentety
    private function checkkQty(Product $product, $qty)
    {
        if ($product->qty <= 0) return false;

        return $product->qty >= $qty ? true : false;
    }
}
