<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ParkingPlace;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function view(Request $request): View
    {

        return view('Pelanggan.dashboard');
    }
    public function lokasi(Request $request,$id)
    {
        $data = ParkingPlace::findOrFail($id);
        return view('Pelanggan.detail_transaksi', compact('data'));
    }
    public function location(Request $request)  
    {
        $locations = ParkingPlace::select([
            'place_id', 
            'name_place', 
            'status_place', 
            'image', 
            'slot_tersedia', 
            'harga_awal', 
            DB::raw("CAST(SUBSTRING_INDEX(lokasi, ',', 1) AS DECIMAL(10,6)) AS latitude"), 
            DB::raw("CAST(SUBSTRING_INDEX(lokasi, ',', -1) AS DECIMAL(10,6)) AS longitude")
        ])
        ->whereNotNull('lokasi')
        ->get();
    
        return response()->json($locations);
    }

}
