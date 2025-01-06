<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ShippingRulesDataTable;
use App\Http\Controllers\Controller;
use App\Models\ShippingRules;
use Illuminate\Http\Request;

class ShippingRulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShippingRulesDataTable $datatable)
    {
        return $datatable->render('admin.shipping-rule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shipping-rule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => ['required', 'unique:shipping_rules,name'],
            "price" => ['required', 'numeric', 'min:0'],
            "min_order_value" => ['required', 'numeric', 'min:0'],
            "max_order_value" => ['required', 'numeric', 'gte:min_order_value'], // Ensures max is greater than or equal to min
            "type" => ['required', 'in:flat,weight_based,free,location_based'], // Matches the enum values
            "status" => ['required', 'boolean'],
        ]);

        ShippingRules::create($data);

        toastr('Shipping Rule Created Successfully');
        return to_route('admin.shippingRule.index');
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
        $shippingRule = ShippingRules::findOrFail($id);

        return view('admin.shipping-rule.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shippingRule = ShippingRules::findOrFail($id);

        $data = $request->validate([
            "name" => ['required', 'unique:shipping_rules,name,' . $shippingRule->id],
            "price" => ['required', 'numeric', 'min:0'],
            "min_order_value" => ['required', 'numeric', 'min:0'],
            "max_order_value" => ['required', 'numeric', 'gte:min_order_value'],
            "type" => ['required', 'in:flat,weight_based,free,location_based'],
            "status" => ['required', 'boolean'],
        ]);

        $shippingRule->update($data);

        toastr('Shipping Rule Updated Successfully');
        return to_route('admin.shippingRule.index');
    }

    /**
     * Update Status
     */
    public function updateStatus(Request $request)
    {
        $data = $request->validate([
            'id' => ['required', 'exists:shipping_rules,id'],
            'status' => ['required', 'boolean'],
        ]);

        $shippingRule = ShippingRules::findOrFail($request->id);

        $shippingRule->status = $request->status;
        $shippingRule->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $shippingRuleID)
    {
        $shippingRule = ShippingRules::findOrFail($shippingRuleID);
        $shippingRule->delete();

        return response()->json(['status' => 'success', 'message' => 'Shipping Rule Deleted Successfully']);
    }
}
