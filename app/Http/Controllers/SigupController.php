<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SigupController extends Controller
{
    public function sigup()
    {
        return view('pages.sigup.sigup');
    }
}
