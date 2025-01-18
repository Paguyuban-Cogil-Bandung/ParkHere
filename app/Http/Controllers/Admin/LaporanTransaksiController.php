<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use GuzzleHttp\Client;
use App\Models\User;

class LaporanTransaksiController extends Controller
{
    public function view(Request $request)
    {
        // Fetch filters
        $usertype = $request->input('usertype');
        $email = $request->input('email');
        $name = $request->input('name');

        // Query with filters
        $query = User::query();

        if (!empty($usertype)) {
            $query->where('usertype', $usertype);
        }
        if (!empty($email)) {
            $query->where('email', 'LIKE', '%' . $email . '%');
        }
        if (!empty($name)) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }

        $users = $query->get();
        return response()->json(['users' => $users]);
        // return view('Admin.laporan_transaksi', compact('users')); // Return the view for the user list
    }
    public function index(Request $request): view
    {
        return view('Admin.laporan_transaksi');
    }
}
