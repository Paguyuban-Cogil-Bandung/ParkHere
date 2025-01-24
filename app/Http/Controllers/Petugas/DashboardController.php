<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\ParkingPlace;
use App\Models\Booking;
use App\Models\ListPetugas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function view(Request $request): View
    {
       // Ambil ID user yang sedang login
        $id = Auth::id();

        // Ambil semua place_id yang terkait dengan user
        $list_petugas = ListPetugas::where('user_id', $id)->pluck('place_id');

        // Ambil data ParkingPlace berdasarkan place_id
        $parking_places = ParkingPlace::findOrFail($list_petugas);

        
        $bookings = Booking::where('place_id', $list_petugas)->get();

        $jumlah_slot_tersedia = ParkingPlace::where('place_id', $list_petugas)->sum('slot_tersedia');
        $jumlah_slot = ParkingPlace::where('place_id', $list_petugas)->sum('jumlah_slot');
        $jumlah_slot_terisi = $jumlah_slot - $jumlah_slot_tersedia;
        $jumlah_booking_pending = Booking::whereIn('place_id', $list_petugas)->where('status_booking', 'Pending')->count();
        $total_transaksi_today = Booking::whereIn('place_id', $list_petugas)->sum('total_bayar');

        // dd($total_transaksi_today);

        // dd($parking_places);
        return view('Petugas.dashboard', compact('parking_places', 'bookings', 'jumlah_slot_tersedia', 'jumlah_slot_terisi', 'jumlah_booking_pending', 'total_transaksi_today'));
    }
    public function toggleStatus(Request $request, $id)
    {
        // Cari data berdasarkan ID
        $parkingPlace = ParkingPlace::findOrFail($id);

        // Update status
        $parkingPlace->status_place = $request->input('status');
        $parkingPlace->save();
    
        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui',
            'status' => $parkingPlace->status,
        ]);
    }
    public function updateImage(Request $request, $id)
    {
        // Validasi file gambar
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $parkingPlace = ParkingPlace::findOrFail($id);

        // Hapus gambar lama jika ada dan file tersebut benar-benar ada di storage
        if ($parkingPlace->image && Storage::exists('public/' . $parkingPlace->image)) {
            Storage::delete('public/' . $parkingPlace->image); 
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('public/images', $fileName);

            $parkingPlace->image = 'images/' . $fileName;
            $parkingPlace->save();
        }

        // Kembalikan respons JSON
        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil diperbarui',
            'newImagePath' => asset('images/' . $fileName) // Kirim URL gambar baru ke frontend
        ]);
    }

}
