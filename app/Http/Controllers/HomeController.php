<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function userHome()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.dashboard'); // View cho admin
        }

        return view('home'); // View cho user thường
    }
}
