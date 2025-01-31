<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Auth;
use App\Models\Booking;
use App\Models\ListPetugas;
use App\Models\ParkingPlace;
class LaporanTransaksiController extends Controller
{
    public function view(Request $request): View
    {
        // Ambil ID user yang sedang login
        $id = Auth::user()->id;

        // Ambil semua place_id yang terkait dengan user
        $list_petugas = ListPetugas::where('user_id', $id)->pluck('place_id');

        // Ambil data ParkingPlace berdasarkan place_id
        $parkingPlaces = ParkingPlace::findOrFail($list_petugas);

        
        $bookings = Booking::where('place_id', $list_petugas)->get();
        return view('Petugas.laporan_transaksi', compact('bookings', 'parkingPlaces'));
    }
    public function index(Request $request)
    {
        $validated = $request->validate([
            'booking_id'   => 'nullable|integer',
            'parkir'       => 'nullable|string|max:255',
            'metode_bayar' => 'nullable|string|max:255',
            'start_time'   => 'nullable|date',
            'end_time'     => 'nullable|date|after_or_equal:start_time',
        ]);

        $id = Auth::id();
        $list_petugas = ListPetugas::where('user_id', $id)->pluck('place_id');

        if ($list_petugas->isEmpty()) {
            return response()->json(['reports' => []]);
        }

        $reports = Booking::query()
            ->when(filled($validated['booking_id'] ?? null), function ($query) use ($validated) {
                $query->where('booking_id', $validated['booking_id']);
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
            ->where('place_id', $list_petugas)
            ->get();

        return response()->json(['reports' => $reports]);
    }

}
