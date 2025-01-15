<?php

// namespace App\Helpers;

// for sidebar activation 

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

function setActive($route)
{
    if (is_array($route)) {
        foreach ($route as $r) {
            if (request()->routeIs($r)) return 'active';
        }
    }
}

function discountPercentage($originalPrice, $discountedPrice)
{
    $discountPercentage = (($originalPrice - $discountedPrice) / $originalPrice) * 100;
    return intval($discountPercentage); // Returns only the integer part
}

function productStatus($product)
{
    if ($product->is_top) {
        return "Top";
    } elseif ($product->is_best) {
        return "Best";
    }

    return "";
}

function checkIfPriceNotSameToOfferPrice($price, $offerPrice)
{
    if ($price >= $offerPrice) return true;

    return false;
}

function checkDiscount(Product $product)
{
    // Check if offerPrice is set and greater than 0
    return $product->offer_price && $product->offer_price > 0;
}

function getTotalCartAmount()
{
    return Cart::total(2, '.', ',') - Cart::tax(2, '.', ',');
}
