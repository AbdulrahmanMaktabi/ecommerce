<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index(FlashSaleDataTable $datatable)
    {
        return $datatable->render('admin.flash-sale.index');
    }
}
