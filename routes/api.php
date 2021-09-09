<?php

use App\Models\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ActionsApiController;
use \App\Http\Controllers\UserAuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/actions',[ActionsApiController::class, 'index']);
Route::get('/actions/{id}', [ActionsApiController::class, 'indexByUserId']);
Route::post('/actions', [ActionsApiController::class, 'store']);
Route::put('/actions/{action}', [ActionsApiController::class, 'update']);
Route::delete('/actions/{action}', [ActionsApiController::class, 'destroy']);

Route::post('/auth', [UserAuthController::class, 'index']);
