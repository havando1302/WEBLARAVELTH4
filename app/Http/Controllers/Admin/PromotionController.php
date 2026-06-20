<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        // For now, return the view. You can pass promotion data here later.
        return view('admin.promotions.index');
    }
}
