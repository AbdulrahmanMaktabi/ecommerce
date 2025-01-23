<?php

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


function getShippingRule($orderValue)
{
    // Fetch the applicable shipping rule
    $shippingRule = DB::table('shipping_rules')
        ->where('status', 1) // Only active rules
        ->where(function ($query) use ($orderValue) {
            $query->where('min_order_value', '<=', $orderValue)
                ->where(function ($subQuery) use ($orderValue) {
                    $subQuery->whereNull('max_order_value') // No upper limit
                        ->orWhere('max_order_value', '>=', $orderValue); // Within upper limit
                });
        })
        ->orderBy('min_order_value', 'desc') // Prioritize rules with higher minimum values
        ->get();

    return $shippingRule;
}

function calculateCouponDiscount()
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

function calculateTotal()
{
    $subtotal = (float) str_replace(',', '', Cart::subtotal(2, '.', ','));
    $tax = (float) str_replace(',', '', Cart::tax(2, '.', ','));

    // Calculate the discount using the coupon function
    $discount = calculateCouponDiscount();

    // Calculate the final total
    $final = $subtotal - $discount;
    // $finalTotal = $finalSubtotal + $tax; // Add tax back to the discounted subtotal

    // return response()->json([
    //     'status' => 'success',
    //     'message' => 'Success',
    //     'subtotal' => $subtotal,
    //     'tax' => $tax,
    //     'discount' => $discount,
    //     'total' => $final,
    // ]);

    return $final;
}
