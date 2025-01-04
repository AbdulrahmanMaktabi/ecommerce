<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashSaleItem;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\FlashSale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlashSaleItemsController extends Controller
{
    public function index(FlashSaleItemDataTable $datatable, $flashSaleID)
    {
        $flashSale = FlashSale::findOrFail($flashSaleID);

        return $datatable->render('admin.flash-sale.items.index', get_defined_vars());
    }

    public function create($flashSaleID)
    {
        $flashSale = FlashSale::findOrFail($flashSaleID);

        $categories = Category::status(1)->get();

        // $products = Product::where('vendor_id', Auth::user()->vendor->id)
        //     ->status(1)
        //     ->get();

        return view('admin.flash-sale.items.create', get_defined_vars());
    }

    public function store(Request $request, $flashSaleID)
    {
        $flashSale = FlashSale::findOrFail($flashSaleID);

        $request->validate([
            'products' => 'required|array',
            'discounted_price' => 'required|array',
            'discounted_price.*' => 'numeric|min:0',
        ]);

        foreach ($request->products as $productId) {
            $flashSaleItem = new FlashSaleItem();
            $flashSaleItem->flash_sale_id = $flashSale->id;
            $flashSaleItem->product_id = $productId;
            $flashSaleItem->discounted_price = $request->discounted_price[$productId];

            // Validate the discount before saving
            if (!$flashSaleItem->validateDiscount($request->discounted_price[$productId])) {
                // If the discount is greater than the product price, return an error
                toastr('The discounted price cannot be greater than the product price.', 'error');
                return redirect()->back();
            }

            $flashSaleItem->save();
        }

        toastr('Items added to flash sale successfully.');
        return to_route('admin.flashSale.items.index', ['flashSaleID' => $flashSale->id]);
    }

    public function getProductsByChildCategory($childCategoryId)
    {
        $childCategory = ChildCategory::findOrFail($childCategoryId);

        $products = Product::where('childCategory_id', $childCategoryId)
            ->status(1)
            ->get(['id', 'name']);

        return response()->json($products);
    }

    public function destroy($flashSaleItemID)
    {
        $flashSaleItem = FlashSaleItem::findOrFail($flashSaleItemID);
        $flashSaleItem->delete();

        toastr('Item Deleted Successfully');
        return response()->json(['status' => 'success', 'message' => 'Item Deleted Successfully']);
    }
}
