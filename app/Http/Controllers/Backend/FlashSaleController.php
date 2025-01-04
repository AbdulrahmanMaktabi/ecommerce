<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index(FlashSaleDataTable $datatable)
    {
        return $datatable->render('admin.flash-sale.index');
    }

    public function create()
    {
        return view('admin.flash-sale.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:flash_sales,name'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date'],
            'status' => ['required', 'boolean'],
            'show_on_home' => ['required', 'boolean'],
        ]);

        FlashSale::create($data);

        toastr('Flash Sale Created Successfully');
        return to_route('admin.flashSale.index');
    }
}
