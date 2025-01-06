<?php

namespace App\Http\Controllers\Backedn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\CouponDataTable;
use App\Models\Coupon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CouponDataTable $datatable)
    {
        return $datatable->render('admin.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:coupons,name',
            'code' => 'required|string|max:255|unique:coupons,code',
            'discount_amount' => 'required|numeric|min:0.01',
            'discount_type' => 'required|in:percentage,amount',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'usage_limit' => 'required|integer|min:1',
            'used_count' => 'required|integer|min:1',
            'status' => 'required|boolean',
        ]);

        Coupon::create($data);
        toastr('Coupon Created Successfully');

        return to_route('admin.coupon.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('admin.coupon.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $coupon = Coupon::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255|unique:coupons,name,' . $coupon->id,
            'code' => 'required|string|max:255|unique:coupons,code,' . $coupon->id,
            'discount_amount' => 'required|numeric|min:0.01',
            'discount_type' => 'required|in:percentage,amount',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'usage_limit' => 'required|integer|min:1',
            'used_count' => 'required|integer|min:1',
            'status' => 'required|boolean',
        ]);

        $coupon->update($data);

        toastr('Coupon Updated Successfully');

        return to_route('admin.coupon.index');
    }

    /**
     * Update Status
     */
    public function updateStatus(Request $request)
    {
        $data = $request->validate([
            'id' => ['required', 'exists:coupons,id'],
            'status' => ['required', 'boolean'],
        ]);

        $coupon = Coupon::findOrFail($request->id);

        $coupon->status = $request->status;
        $coupon->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::findOrFail($id);

        $coupon->delete();
        return response()->json(['status' => 'success', 'message' => 'Coupon Deleted Successfully']);
    }
}
