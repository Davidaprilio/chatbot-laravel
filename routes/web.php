<?php

use App\Models\Message;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('baru', function () {
    return view('form-message');
});


Route::get('/buat', function () {

    return view('create-message', [
        'messages' => Message::all()
    ]);
});