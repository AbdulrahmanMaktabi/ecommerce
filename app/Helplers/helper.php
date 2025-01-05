<?php

// namespace App\Helpers;

// for sidebar activation 
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
    return (($originalPrice - $discountedPrice) / $originalPrice) * 100;
}
