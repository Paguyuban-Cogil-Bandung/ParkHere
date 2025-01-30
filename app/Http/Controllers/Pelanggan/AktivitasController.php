<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Booking;
use Auth;

class AktivitasController extends Controller
{
    public function view(Request $request): View
    {
        $bookings = Booking::where('user_id', Auth::user()->id)->get();
        return view('Pelanggan.aktivitas', compact('bookings'));
    }
    
}
