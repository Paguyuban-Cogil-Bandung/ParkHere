<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ParkingPlace;

class TransaksiController extends Controller
{
    public function view(Request $request, $id): View
    {
        $data = ParkingPlace::findOrFail($id);
        return view('Pelanggan.detail_transaksi', compact('data'));
    }
    
}
