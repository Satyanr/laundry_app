<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\OrderTbl;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorHTML;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function orderan(Request $request)
    {
        // $sttsbyr = $request->input('sttsbyr');
        $status = $request->input('status');
        $start = Carbon::createFromFormat('Y-m-d', $request->input('start'));
        $end = Carbon::createFromFormat('Y-m-d', $request->input('end'));
        // if ($sttsbyr != null) {
        //     if ($start == $end) {
        //         $orderan = OrderTbl::whereDate('order_tbls.created_at', $start)->join('pembayaran_tbls', 'pembayaran_tbls.status_pembayaran')->where('pembayaran_tbls.status_pembayaran', $sttsbyr)->get();
        //     } else {
        //         $orderan = OrderTbl::whereBetween('order_tbls.created_at', [$start, $end])
        //             ->join('pembayaran_tbls.status_pembayaran', $sttsbyr)
        //             ->get();
        //     }
        // } elseif ($status != null) {
        if ($status != null) {
            if ($start == $end) {
                $orderan = OrderTbl::whereDate('created_at', $start)->where('status', $status)->get();
            } else {
                $orderan = OrderTbl::whereBetween('created_at', [$start, $end])
                    ->where('status', $status)
                    ->get();
            }
        } else {
            if ($start == $end) {
                $orderan = OrderTbl::whereDate('created_at', $start)->get();
            } else {
                $orderan = OrderTbl::whereBetween('created_at', [$start, $end])->get();
            }
        }
        $data = [
            'orders' => $orderan,
        ];

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pdf.laporan-pdf', $data)->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function barcode($id)
    {
        $code_laundry = OrderTbl::where('id', $id)->first()->kode_laundry;
        $order = OrderTbl::where('id', $id)->first();
        // $generatorHTML = new BarcodeGeneratorHTML();
        // $barcode = $generatorHTML->getBarcode('stytzy'.$id , $generatorHTML::TYPE_CODE_128);
        $barcode = QrCode::size(500)->generate('Demo');

        $data = [
            'code' => $code_laundry,
            'barcode' => $barcode,
            'order' => $order,
        ];

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pdf.barcode', $data)->setPaper('a4', 'landscape');

        return $pdf->download('barcode' . $code_laundry . '.pdf');
    }
}
