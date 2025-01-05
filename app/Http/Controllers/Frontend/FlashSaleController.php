<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashSale;

class FlashSaleController extends Controller
{
    public function index()
    {
        $flashSale = FlashSale::status(true)
            ->showOnHome(true)
            ->where('name', '2025 Flash')
            ->first();

        return view('frontend.pages.flashSale', get_defined_vars());
    }
}
