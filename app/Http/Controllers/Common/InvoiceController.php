<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //invoice page show
    public function invoiceshow()
    {
        return view('common_backend.invoice.invoice_show');
    }
}
