<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ParkingPlace;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function view(Request $request): View
    {
        $booking = Booking::where('user_id', Auth::user()->id)->whereIn('status_booking', ['Pending', 'Check In'])->first();
        return view('Pelanggan.dashboard', compact('booking'));
    }
    public function lokasi(Request $request,$id)
    {
        $data = ParkingPlace::findOrFail($id);
        return view('Pelanggan.detail_lokasi', compact('data'));
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
            'harga_per_jam', 
            DB::raw("CAST(SUBSTRING_INDEX(lokasi, ',', 1) AS DECIMAL(10,6)) AS latitude"), 
            DB::raw("CAST(SUBSTRING_INDEX(lokasi, ',', -1) AS DECIMAL(10,6)) AS longitude")
        ])
        ->whereNotNull('lokasi')
        ->whereIn('status_place', ['Buka', 'Penuh'])
        ->get();
    
        return response()->json($locations);
    }
    public function booking(Request $request)
    {
        try {
            DB::beginTransaction();

            $bookings = new Booking();
            $bookings->user_id = $request->id_user;
            $bookings->place_id = $request->booking_id;
            $bookings->name_user = $request->name_user;
            $bookings->no_plat = $request->no_plat;
            $bookings->name_place = $request->name_place;
            $bookings->status_booking = 'Pending';
            $bookings->status_bayar = 'Belum Bayar';
            $bookings->harga_awal = $request->harga_awal;
            $bookings->harga_per_jam = $request->harga_per_jam;
            $bookings->save();

            $place = ParkingPlace::findOrFail($request->booking_id);
            $place->slot_tersedia = $place->slot_tersedia - 1;
            $place->jumlah_booking = $place->jumlah_booking + 1;
            $place->save();
            DB::commit();

            return response()->json(['message' => 'Data berhasil ditambahkan'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Terjadi kesalahan: ' . $th->getMessage()], 500);
        }
    }

    public function changeBookingStatus(Request $request) {
        try {
            DB::beginTransaction();

            $booking = Booking::findOrFail($request->booking_id);
            $booking->status_booking = $request->status_booking;
            $booking->save();

            $place = ParkingPlace::findOrFail($booking->place_id);
            $is_change_slot = $request->status_booking == 'Check Out' && $request->status_booking == 'Cancelled';
            if ($is_change_slot) {
                $place->slot_tersedia = $place->slot_tersedia + 1;
                $place->jumlah_booking = $place->jumlah_booking - 1;
            }
            $place->save();

            DB::commit();

            return response()->json(['message' => 'Status booking berhasil diubah'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Terjadi kesalahan: ' . $th->getMessage()], 500);
        }
    }
    public function bayar(Request $request) {
        try {
            DB::beginTransaction();

            $booking = Booking::findOrFail($request->booking_id);
            $booking->status_bayar = 'Bayar';
            $booking->jam_bayar = date('Y-m-d H:i:s');
            $booking->durasi = $request->durasi; 
            $booking->total_bayar = $request->total_bayar ; 
            $booking->tambahan_bayar = 0; 
            $booking->metode_bayar = $request->metode_bayar; 
            $booking->save();

            DB::commit();

            return response()->json(['message' => 'Berhasil Dibayar'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Terjadi kesalahan: ' . $th->getMessage()], 500);
        }
    }
}
