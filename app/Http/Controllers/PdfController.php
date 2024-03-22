<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\OrderTbl;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function orderan(Request $request)
    {
        $start = Carbon::createFromFormat('Y-m-d', $request->input('start'));
        $end = Carbon::createFromFormat('Y-m-d', $request->input('end'));

        $orderan = OrderTbl::whereBetween('created_at', [$start, $end])->get();
        $data = [
            'orders' => $orderan,
        ];


        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pdf.laporan-pdf', $data)->setPaper('a4', 'landscape');;

        return $pdf->stream();

    }
}
