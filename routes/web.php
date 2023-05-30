<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\FlowChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('auth.login');
});
// logout
Route::any('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::prefix('login')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/store', [AuthController::class, 'attemptLogin'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::prefix('/')->controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    Route::prefix('/user')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('user');
        Route::get('/credit', 'credit')->name('user.credit');
        Route::any('/store', 'store')->name('user.store');
        Route::any('/remove', 'remove')->name('user.remove');
    });

    Route::prefix('/message')->controller(MessageController::class)->group(function () {
        Route::get('/', 'index')->name('message');
        Route::get('/credit', 'credit')->name('message.credit');
        Route::post('/store', 'store')->name('message.store');
        Route::any('/remove', 'remove')->name('message.remove');
        Route::view('/form-concept', 'whatsapp.message.form');
    });

    Route::prefix('/action-replies')->controller(MessageController::class)->group(function () {
        Route::get('/', 'indexAR')->name('action-replies');
        Route::get('/credit', 'creditAR')->name('action-replies.credit');
        Route::post('/store', 'storeAR')->name('action-replies.store');
        Route::any('/remove', 'remove')->name('action-replies.remove');
    });

    Route::prefix('/chatbot')->group(function () {
        Route::prefix('/flow')->controller(FlowChatController::class)->group(function () {
            Route::get('/', 'index')->name('flowchat.index');
            Route::get('/{flowChat:id}', 'show')->name('flowchat.show');
            Route::post('/save', 'save')->name('flowchat.save');
            Route::delete('/{flowChat:id}', 'delete')->name('flowchat.delete');
            Route::get('/{flowChat:id}/graph', 'graph_view')->name('flowchat.graph');
        });
    });

    Route::prefix('/profile')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'index')->name('profile');
        Route::get('/edit_password', 'index')->name('profile.edit_password');
        Route::post('/store', 'store')->name('profile.store');
        Route::any('/save', 'save_profile')->name('profile.save_profile');
    });

    Route::prefix('/customer')->controller(CustomerController::class)->group(function () {
        Route::get('/', 'index')->name('customer');
        Route::get('/credit', 'credit')->name('customer.credit');
        Route::any('/store', 'store')->name('customer.store');
        Route::any('/remove', 'remove')->name('customer.remove');
    });

    Route::prefix('/device')->controller(DeviceController::class)->group(function () {
        Route::get('/', 'index')->name('device');
        Route::post('/store', 'store')->name('device.store');
        Route::get('/remove', 'remove')->name('device.remove');
        Route::get('/detail/{id}', 'detail')->name('device.detail');
        Route::get('/show/{id}', 'qrcode')->name('device.qrcode');
        Route::get('/{id}/qrcode', 'start')->name('device.start');
        Route::any('/{id}/start', 'start')->name('device.start2');
        Route::any('/{id}/logout', 'logout')->name('device.logout');
        // test
        Route::get('/{id}/test', 'test')->name('device.test');
    });
});
