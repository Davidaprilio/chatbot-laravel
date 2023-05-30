<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        dd(format_phone('+62) 806 3528 630'));
    }
}
