<?php

use App\Http\Controllers\GraphController;
use App\Http\Controllers\HookController;
use App\Http\Controllers\TestController;
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


Route::any('/testing', [TestController::class, 'index']);

Route::any('hook/whatsapp', [HookController::class, 'callback']);
Route::any('hook/whatsapp/test', [HookController::class, 'test']);

Route::get('graph/message', [GraphController::class, 'index']);
Route::post('graph/message', [GraphController::class, 'saveMessage']);
Route::delete('graph/{flowChat:id}/message', [GraphController::class, 'deleteMessage']);
Route::get('graph/action-reply', [GraphController::class, 'getActionReply']);
Route::post('graph/action-reply', [GraphController::class, 'saveActionReply']);
Route::delete('graph/{flowChat:id}/action-reply', [GraphController::class, 'deleteActionReply']);
Route::post('graph/message/node', [GraphController::class, 'nodeMessageStore']);
Route::post('graph/flowchat/{flowChat:id}', [GraphController::class, 'updateFlowChat']);
