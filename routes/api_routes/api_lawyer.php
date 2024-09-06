<?php
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=> 'v1', 'middleware'=> ['auth:lawyer']], function(){
        //  Route::get('/lawyers', [SupervisorController::class, 'getLawyers']);
         Route::get('/clients/supervisor/{id}', [App\Http\Controllers\Lawyer\SupervisorController::class, 'getClients']);
         Route::get('/lawyers/supervisor/{id}', [App\Http\Controllers\Lawyer\SupervisorController::class, 'getLawyers']);
        //  Route::get('/note/supervisor/{id}', [App\Http\Controllers\Lawyer\NoteController::class, 'index']);

         Route::get('/case/supervisor/{id}', [App\Http\Controllers\Lawyer\NoteCaseController::class, 'index']);
          Route::post('/case/{id}', [App\Http\Controllers\Lawyer\NoteCaseController::class, 'show']);
         Route::post('/cases/create', [App\Http\Controllers\Lawyer\NoteCaseController::class, 'store']);
         Route::post('/case/update/{id}', [App\Http\Controllers\Lawyer\NoteCaseController::class, 'update']);
         Route::post('/case/delete/{id}', [App\Http\Controllers\Lawyer\NoteCaseController::class, 'destroy']);
    });