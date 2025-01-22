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
    if ($originalPrice == 0 || $discountedPrice == 0) return 0;
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
    $total = (float) str_replace(',', '', Cart::total(2, '.', ','));
    $tax = (float) str_replace(',', '', Cart::tax(2, '.', ','));

    return $total - $tax;
}
