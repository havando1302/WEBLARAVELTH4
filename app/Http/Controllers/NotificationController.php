<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $notifications = $request->user()->notifications()->latest()->get();
        return view('notifications.index', compact('notifications'));
    }
}
