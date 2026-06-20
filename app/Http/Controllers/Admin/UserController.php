<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // For now, return the view. You can pass user data here later.
        return view('admin.users.index');
    }
}
