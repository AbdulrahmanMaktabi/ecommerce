<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', '1')->orderBy('serial', 'asc')->get();

        $products = Product::status(true)->get();

        $flashSale = FlashSale::status(true)
            ->notEnded()
            ->with(['items' => function ($query) {
                $query->whereHas('product.category', function ($q) {
                    $q->where('status', 1); // Ensure the category is active
                });
            }])
            ->showOnHome(true)
            ->where('name', '2025 Flash')
            ->first();

        return view('frontend.home.index', get_defined_vars());
    }
}
