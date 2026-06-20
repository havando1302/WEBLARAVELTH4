<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // For now, return the view. You can pass report data here later.
        return view('admin.reports.index');
    }
}
