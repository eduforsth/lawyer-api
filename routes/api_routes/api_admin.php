<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

Route::post('/v1/admin/register', [AdminController::class, 'register']);
Route::post('/v1/admin/login', [AdminController::class, 'login']);
// Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy']);
Route::group(['prefix'=> 'v1', 'middleware'=> ['auth:admin']], function(){
    //Supervisor
      Route::post('/supervisor/register', [App\Http\Controllers\Admin\SupervisorController::class, 'register']);
      Route::get('/supervisor/index', [App\Http\Controllers\Admin\SupervisorController::class, 'index']);
      Route::post('/supervisor/{id}', [App\Http\Controllers\Admin\SupervisorController::class, 'show']);
      Route::post('/supervisor/delete/{id}', [App\Http\Controllers\Admin\SupervisorController::class, 'destroy']);

      Route::get('/lawyers/supervisor/{id}', [App\Http\Controllers\Admin\SupervisorController::class, 'getLawyers']);
      Route::get('/clients/supervisor/{id}', [App\Http\Controllers\Admin\SupervisorController::class, 'getClients']);

});
