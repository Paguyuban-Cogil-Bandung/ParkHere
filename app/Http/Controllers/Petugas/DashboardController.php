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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

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


        $bookings = Booking::whereIn('place_id', $list_petugas)
                ->whereDate('created_at', Carbon::today())
                ->orderBy('booking_id', 'desc')
                ->get();
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
    public function checkin(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                // Validasi input
                $booking = Booking::findOrFail($request->booking_id);

                // Update status booking
                $booking->status_booking = "Check In";
                $booking->jam_checkin = now();
                $booking->save();

                // Update tempat parkir
                $place = ParkingPlace::findOrFail($booking->place_id);
                $place->slot_tersedia = max(0, $place->slot_tersedia - 1);  // Pastikan tidak negatif
                $place->save();

                // Kirim request ke API parkir
                $response = Http::get('https://parkhere-backend.ourproject.my.id/mqtt', [
                    'topic' => 'parking/action',
                    'message' => json_encode([
                        'type' => 'action',
                        'device' => 'SRV1',
                        'state' => 1
                    ])
                ]);

                // Jika API gagal, lempar exception agar transaksi di-rollback
                if (!$response->successful()) {
                    throw new \Exception('Gagal mengirim perintah ke perangkat');
                }
            });

            return response()->json(['message' => 'Check-in berhasil dan palang terbuka'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $th->getMessage()], 500);
        }
    }
    public function checkout(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                // Update status booking
                $booking = Booking::findOrFail($request->booking_id);
                $booking->status_booking = "Check Out";
                $booking->jam_checkout = now();
                $booking->save();

                // Update tempat parkir
                $place = ParkingPlace::findOrFail($booking->place_id);
                $place->slot_tersedia = max(0, $place->slot_tersedia + 1); // Pastikan tidak negatif
                $place->jumlah_booking = max(0, $place->jumlah_booking - 1); // Pastikan tidak negatif
                $place->save();

                // Kirim request ke API parkir
                $response = Http::get('https://parkhere-backend.ourproject.my.id/mqtt', [
                    'topic' => 'parking/action',
                    'message' => json_encode([
                        'type' => 'action',
                        'device' => 'SRV2',
                        'state' => 1
                    ])
                ]);

                // Jika API gagal, lempar exception untuk rollback
                if (!$response->successful()) {
                    throw new \Exception('Gagal mengirim perintah ke perangkat');
                }
            });

            return response()->json(['message' => 'Check out berhasil dan palang terbuka'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $th->getMessage()], 500);
        }
    }

}
