<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ParkingPlace;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function view(Request $request): View
    {
        $pendapatan_hari_ini = Booking::whereBetween('jam_bayar', [Carbon::today(), Carbon::now()])->sum('total_bayar');
        $transaksi_hari_ini = Booking::whereBetween('created_at', [Carbon::today(), Carbon::now()])->count();
        $tempat_parkir_buka = ParkingPlace::where('status_place', 'Buka')->count();
        $jumlah_pelanggan = User::where('userType', 'Pelanggan')->count();
        $table_transaktions = Booking::whereNotNull('jam_checkin')->orderBy('jam_checkin', 'desc')->get();
        $table_places = ParkingPlace::get();
        return view('Admin.dashboard', compact('transaksi_hari_ini', 'pendapatan_hari_ini', 'tempat_parkir_buka', 'jumlah_pelanggan', 'table_transaktions', 'table_places'));
    }
}
