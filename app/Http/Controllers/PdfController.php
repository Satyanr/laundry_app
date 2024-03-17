<?php

namespace App\Http\Controllers;

use App\Models\OrderTbl;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function orderan()
    {
        $orderan = OrderTbl::all();
        $data = [
            'orders' => $orderan,
        ];


        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pdf.laporan-pdf', $data)->setPaper('a4', 'landscape');;

        return $pdf->stream();

    }
}
