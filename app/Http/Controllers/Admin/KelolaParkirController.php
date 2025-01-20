<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ParkingPlace;
use App\Models\ListPetugas;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class KelolaParkirController extends Controller
{
    public function view(Request $request): View
    {
        $places = ParkingPlace::with(['listPetugas.user'])->get(); 
        $list_petugas = ListPetugas::with('user')->get();
        $users = User::where('usertype', 'petugas')->get();
        return view('Admin.kelola_parkir', compact('places', 'list_petugas', 'users'));
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();

            $place_parking = new ParkingPlace();
            $place_parking->name_place = $request->name_place;
            $place_parking->slot_tersedia = $request->slot_tersedia;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                $place_parking->image = $filename;
            }

            $place_parking->jumlah_slot = $request->jumlah_slot;
            $place_parking->jumlah_booking = $request->jumlah_booking;
            $place_parking->lokasi = $request->lokasi;
            $place_parking->url_stream = $request->url_stream;
            $place_parking->harga_awal = $request->harga_awal;
            $place_parking->harga_per_jam = $request->harga_per_jam;
            $place_parking->save();

            $list_petugas = new ListPetugas();
            $list_petugas->user_id = $request->user_id;
            $list_petugas->place_id = $place_parking->place_id;
            $list_petugas->save();

            DB::commit();

            return response()->json(['message' => 'Data berhasil ditambahkan'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Terjadi kesalahan: ' . $th->getMessage()], 500);
        }
    }
}
