<?php

namespace App\Http\Controllers;

use App\Models\OrderTbl;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function infoLaundryan($kode_laundry)
    {
        $ldr = OrderTbl::where('kode_laundry', $kode_laundry)->first(); 
        return view('pages.info-laundryan', compact('ldr'));
    }
}
