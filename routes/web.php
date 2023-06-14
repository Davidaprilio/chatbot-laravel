<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\FlowChatController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QaController;
use App\Http\Controllers\TopicController;
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

    Route::prefix('/user')->controller(UserController::class)->middleware(['can:sudo,admin'])->group(function () {
        Route::get('/', 'index')->name('user');
        Route::get('/credit', 'credit')->name('user.credit');
        Route::any('/store', 'store')->name('user.store');
        Route::any('/remove', 'remove')->name('user.remove');
    });

    Route::prefix('/message/{flow}')->controller(MessageController::class)->group(function () {
        Route::get('/', 'index')->name('message');
        Route::get('/credit', 'credit')->name('message.credit');
        Route::post('/store', 'store')->name('message.store');
        Route::any('/remove', 'remove')->name('message.remove');
        Route::view('/form-concept', 'whatsapp.message.form');
    });

    Route::prefix('/imessage')->controller(MessageController::class)->group(function () {
        Route::get('/', 'index')->name('imessage');
        Route::get('/credit', 'inertia_create_msg')->name('imessage.credit');
        Route::post('/store', 'inertia_store')->name('imessage.store');
        Route::any('/remove', 'remove')->name('imessage.remove');
        Route::view('/form-concept', 'whatsapp.imessage.form');
    });

    Route::prefix('/chatting')->controller(ChatController::class)->group(function () {
        Route::get('/', 'index')->name('chatting');
        Route::get('/{customer}/view', 'view_chat')->name('chatting.view');
        Route::get('/{customer}/view', 'view_chat')->name('chatting.view');
    });
    Route::prefix('/chatting/topics')->controller(TopicController::class)->group(function () {
        Route::get('/', 'index')->name('topic');
        Route::post('/{topic?}', 'save')->name('topic.save');
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

    Route::prefix('/kontak')->controller(KontakController::class)->group(function () {
        Route::get('/', 'index')->name('kontak');
        Route::get('/credit', 'credit')->name('kontak.credit');
        Route::any('/store', 'store')->name('kontak.store');
        Route::any('/remove', 'remove')->name('kontak.remove');
        Route::get('/export', 'export')->name('kontak.export');
    });

    Route::prefix('/device')->controller(DeviceController::class)->group(function () {
        Route::get('/', 'index')->name('device');
        Route::group(['middleware' => ['can:sudo,admin']], function () {
            Route::post('/store', 'store')->name('device.store');
            Route::get('/remove', 'remove')->name('device.remove');
        });
        Route::get('/detail/{id}', 'detail')->name('device.detail');
        Route::get('/show/{id}', 'qrcode')->name('device.qrcode');
        Route::get('/{id}/qrcode', 'start')->name('device.start');
        Route::any('/{id}/start', 'start')->name('device.start2');
        Route::any('/{id}/logout', 'logout')->name('device.logout');
        Route::get('/{device:id}/flows', 'flows')->name('device.flows');
        Route::post('/{device:id}/flows', 'apply_flows');
        Route::delete('/{device:id}/flows', 'drop_flow');
        // test
        Route::get('/{id}/test', 'test')->name('device.test');
    });

    Route::prefix('/setting-web')->controller(DashboardController::class)->group(function () {
        Route::get('/', 'settingWeb')->name('setting-web');
        Route::post('/store', 'settingWebStore')->name('setting-web.store');
    });

    // QA
    Route::prefix('/qa')->controller(QaController::class)->group(function () {
        Route::get('/', 'index')->name('qa');
        Route::any('/demo', 'demo')->name('qa.demo');
        Route::any('/save-json', 'saveJson')->name('qa.saveJson');
        Route::any('/ajax-load-qa', 'ajaxLoadQA')->name('qa.ajaxLoadQA');
        Route::get('/new', 'new')->name('new.demo');
        Route::get('/lihat', 'lihat')->name('lihat.demo');
    });
});
