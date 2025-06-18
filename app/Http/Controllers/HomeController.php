<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
class HomeController extends Controller
{
    public function userHome()
    {
        $user = Auth::user();
    
        if ($user && $user->role === 'admin') {
            
            return redirect()->route('admin.dashboard');
        }
    
        return view('home');
    }
    
    public function somePage()
    {
        $mainCategory = Category::where('name', 'Sản phẩm')->first();
        return view('yourviewname', compact('mainCategory'));
    }
}
