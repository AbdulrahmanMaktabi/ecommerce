<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaypalSettings;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index()
    {
        $paypal = PaypalSettings::first();
        return view('admin.payments-settings.index', get_defined_vars());
    }
}
