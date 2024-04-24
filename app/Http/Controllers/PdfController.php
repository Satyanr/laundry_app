<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\OrderTbl;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorHTML;

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

    public function barcode($id)
    {
        $code_laundry = OrderTbl::where('id', $id)->first()->kode_laundry;
        $ttlbyr = OrderTbl::where('id', $id)->first()->total_harga;
        $generatorHTML = new BarcodeGeneratorHTML();
        $barcode = $generatorHTML->getBarcode('stytzy'.$id , $generatorHTML::TYPE_CODE_128);
        
        $data = [
            'code' => $code_laundry,
            'barcode' => $barcode,
            'ttlbyr' => $ttlbyr,
        ];


        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pdf.barcode', $data)->setPaper('a4', 'landscape');;

        return $pdf->download('barcode'.$code_laundry.'.pdf');
    }
}
