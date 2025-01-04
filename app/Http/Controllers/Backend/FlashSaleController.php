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
            'start_time' => ['required', 'date', 'before:end_time'],
            'end_time' => ['required', 'date', 'after:start_tim'],
            'status' => ['required', 'boolean'],
            'show_on_home' => ['required', 'boolean'],
        ]);

        FlashSale::create($data);

        toastr('Flash Sale Created Successfully');
        return to_route('admin.flashSale.index');
    }

    public function edit(Request $request, $flashSaleID)
    {
        $flashSale = FlashSale::findOrFail($flashSaleID);

        return view('admin.flash-sale.edit', get_defined_vars());
    }

    public function update(Request $request, $flashSaleID)
    {
        $flashSale = FlashSale::findOrFail($flashSaleID);

        $data = $request->validate([
            'name' => ['required', 'unique:flash_sales,name,' . $flashSale->id],
            'start_time' => ['required', 'date', 'before:end_time'],
            'end_time' => ['required', 'date', 'after:start_tim'],
            'status' => ['required', 'boolean'],
            'show_on_home' => ['required', 'boolean'],
        ]);

        $flashSale->update($data);

        toastr('Flash Sale Updated Successfully');
        return to_route('admin.flashSale.index');
    }

    public function updateStatus(Request $request)
    {
        $data = $request->validate([
            'flashSaleID' => ['required', 'exists:flash_sales,id'],
            'status' => ['required', 'boolean'],
        ]);

        $flashSale = FlashSale::findOrFail($data['flashSaleID']);

        $flashSale->status = $data['status'];
        $flashSale->save();
    }

    public function destroy($flashSaleID)
    {
        $flashSale = FlashSale::findOrFail($flashSaleID);
        $flashSale->delete();
        return response()->json(['status' => 'success', 'message' => 'Flash Sale Deleted Successfully']);
    }
}
