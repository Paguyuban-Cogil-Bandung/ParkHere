<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use GuzzleHttp\Client;
use App\Models\Booking;
use App\Models\ParkingPlace;

class LaporanTransaksiController extends Controller
{
    public function view(Request $request)
    {
        // Fetch filters
        // Validasi input
        $validated = $request->validate([
            'booking_id'   => 'nullable|integer',
            'parkir'       => 'nullable|string|max:255',
            'metode_bayar' => 'nullable|string|max:255',
            'start_time'   => 'nullable|date',
            'end_time'     => 'nullable|date|after_or_equal:start_time',
        ]);

        // Query dengan filter dinamis
        $reports = Booking::query()
            ->when(filled($validated['booking_id'] ?? null), function ($query) use ($validated) {
                $query->where('booking_id', $validated['booking_id']);
            })
            ->when(filled(value: $validated['parkir'] ?? null), function ($query) use ($validated) {
                $query->where('name_place', 'LIKE', '%' . $validated['parkir'] . '%');
            })
            ->when(filled($validated['metode_bayar'] ?? null), function ($query) use ($validated) {
                $query->where('metode_bayar', 'LIKE', '%' . $validated['metode_bayar'] . '%');
            })
            ->when(filled($validated['start_time'] ?? null), function ($query) use ($validated) {
                $query->whereDate('created_at', '>=', $validated['start_time']);
            })
            ->when(filled($validated['end_time'] ?? null), function ($query) use ($validated) {
                $query->whereDate('created_at', '<=', $validated['end_time']);
            })
            ->get();
        return response()->json(['reports' => $reports]);
        // return view('Admin.laporan_transaksi', compact('users')); // Return the view for the user list
    }
    public function index(Request $request): view
    {
        $parkingPlaces = ParkingPlace::all();
        return view('Admin.laporan_transaksi', compact('parkingPlaces'));
    }
}
