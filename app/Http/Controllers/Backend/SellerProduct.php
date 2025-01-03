<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PendingProductsDataTable;
use App\DataTables\SellerProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SellerProduct extends Controller
{
    public function index(SellerProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.sellers.index');
    }

    public function pending(PendingProductsDataTable $dataTable)
    {
        return $dataTable->render('admin.product.pending.index');
    }

    public function updateApprove(Request $request)
    {
        $data = $request->validate([
            'slug' => ['required', 'exists:products,slug'],
            'approve' => ['required', 'boolean'],
        ]);

        $product = Product::where('slug', $data['slug'])->first();
        $product->is_approved = $data['approve'];

        $product->status = $data['approve'];

        $product->save();
    }
}
