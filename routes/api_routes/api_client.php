<?php

use App\Http\Controllers\Client\ClientController;
use Illuminate\Support\Facades\Route;
//for client Role
  // Route::post('/v1/client/login', [\App\Http\Controllers\ClientController::class, 'login']);
      Route::group(['prefix'=> 'v1', 'middleware'=> ['auth:client']], function(){
        Route::post('/client/update', [ClientController::class, 'update']);
        Route::post('/client', [ClientController::class, 'show']);

      Route::get('/lawyers/supervisor/{id}', [App\Http\Controllers\Client\SupervisorController::class, 'getLawyers']);
       
 //  Route::get('/clients', [SupervisorController::class, 'getClients']);
    // Route::get('/note/supervisor/{id}', [App\Http\Controllers\Client\NoteController::class, 'index']);

    Route::get('/case/supervisor/{id}', [App\Http\Controllers\Client\NoteCaseController::class, 'index']);
    Route::post('/case/{id}', [App\Http\Controllers\Client\NoteCaseController::class, 'show']);
    // Route::post('/cases/create', [App\Http\Controllers\Client\NoteCaseController::class, 'store']);
    // Route::post('/case/update/{id}', [App\Http\Controllers\Client\NoteCaseController::class, 'update']);
    // Route::post('/case/delete/{id}', [App\Http\Controllers\Client\NoteCaseController::class, 'destroy']);
    });