<?php

use App\Http\Controllers\GraphController;
use App\Http\Controllers\HookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::any('hook/whatsapp', [HookController::class, 'callback']);
Route::any('hook/whatsapp/test', [HookController::class, 'test']);

Route::get('graph/message', [GraphController::class, 'index']);
Route::post('graph/message', [GraphController::class, 'saveMessage']);
Route::post('graph/message/node', [GraphController::class, 'nodeMessageStore']);