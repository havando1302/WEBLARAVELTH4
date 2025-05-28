<?php

namespace App\Http\Controllers;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index'); 
    }
    public function success()
{
    return view('checkout.success');
}
}
