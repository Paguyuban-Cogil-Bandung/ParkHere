<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanTransaksiController extends Controller
{
    public function view(Request $request): View
    {
        return view('Admin.laporan_transaksi');
    }
}
