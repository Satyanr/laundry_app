<?php

namespace App\Http\Controllers;

use App\Models\OrderTbl;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function transaksi()
    {
        return view('pages.transaksi');
    }

    public function pengguna()
    {
        return view('pages.pengguna');
    }

    public function layanan()
    {
        return view('pages.layanan');
    }

    public function konsumen()
    {
        return view('pages.konsumen');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
