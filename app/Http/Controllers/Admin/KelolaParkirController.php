<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ParkingPlace;
use App\Models\ListPetugas;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
                $path = $file->storeAs('public/images', $filename);
                $place_parking->image = 'images/' . $filename;
            }

            $place_parking->jumlah_slot = $request->jumlah_slot;
            $place_parking->jumlah_booking = $request->jumlah_booking;
            $place_parking->lokasi = $request->lokasi;
            $place_parking->url_stream = $request->url_stream;
            $place_parking->harga_awal = $request->harga_awal;
            $place_parking->harga_per_jam = $request->harga_per_jam;
            $place_parking->save();

            foreach ($request->user_id as $user_id) {
                $list_petugas = new ListPetugas();
                $list_petugas->user_id = $user_id;
                $list_petugas->place_id = $place_parking->place_id;
                $list_petugas->save();
            }
            // $list_petugas = new ListPetugas();

            // $list_petugas->user_id = $request->user_id;
            // $list_petugas->place_id = $place_parking->place_id;
            // $list_petugas->save();

            DB::commit();

            return response()->json(['message' => 'Data berhasil ditambahkan'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Terjadi kesalahan: ' . $th->getMessage()], 500);
        }
    }
    public function find($id)
    {
        $places = ParkingPlace::findOrFail($id); 
        $list_petugas = ListPetugas::where('place_id', $id)->with('user')->get();
        return response()->json([$places, $list_petugas]);
    }
    public function update(Request $request, $id)
    { 
        $place_parking = ParkingPlace::findOrFail($id);
        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                // Hapus file lama dari storage jika ada
                if ($place_parking->image && Storage::exists('public/' . $place_parking->image)) {
                    Storage::delete('public/' . $place_parking->image);
                }
            
                // Simpan file baru ke storage/app/public/images
                $filename = time() . '_' . $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('public/images', $filename);
            
                // Simpan path relatif file ke database (tanpa 'public/')
                $place_parking->image = 'images/' . $filename;
            }
            $place_parking->update([
                'name' => $request->name_place,
                'slot_tersedia' => $request->slot_tersedia,
                'jumlah_slot' => $request->jumlah_slot,
                'jumlah_booking' => $request->jumlah_booking,
                'lokasi' => $request->lokasi,
                'harga_awal' => $request->harga_awal,
                'harga_per_jam' => $request->harga_per_jam,
                'url_stream' => $request->url_stream,
            ]);

            // Update petugas
            ListPetugas::where('place_id', $id)->delete();
            foreach ($request->user_id as $user_id) {
                ListPetugas::create([
                    'user_id' => $user_id,
                    'place_id' => $id,
                ]);
            }

            DB::commit();

            return response()->json(['message' => 'Parking place updated successfully.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to update parking place.', 'error' => $e->getMessage()], 500);
        }
    }
    public function delete(Request $request, $id)
    { 
        DB::beginTransaction();
        try {
            $place_parking = ParkingPlace::findOrFail($id);

            if ($place_parking->image && Storage::exists('public/images/' . $place_parking->image)) {
                Storage::delete('public/images/' . $place_parking->image);
            }
            ParkingPlace::where('place_id', $id)->delete();
            ListPetugas::where('place_id', $id)->delete();

            DB::commit();

            return response()->json(['message' => 'Parking place delete successfully.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to delete parking place.', 'error' => $e->getMessage()], 500);
        }
    }
}
