<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function view(Request $request): View
    {
        return view('Admin.user');
    }

    public function hashpw(Request $request)     
    {
        $hash = Hash::make($request->password);
        return response()->json(['hash' => $hash]);
    }
}
