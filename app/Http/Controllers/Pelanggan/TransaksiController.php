<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransaksiController extends Controller
{
    public function view(Request $request): View
    {
        return view('Pelanggan.detail_transaksi');
    }
    
}
