<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LawyerController;
use App\Http\Controllers\NoteCaseController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SupervisorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
     
//for supervisor Role
Route::post('/v1/supervisor/login', [SupervisorController::class, 'login']);
Route::group(['prefix'=> 'v1', 'middleware'=> ['auth:supervisor']], function(){
        Route::get('/lawyers', [App\Http\Controllers\Supervisor\SupervisorController::class, 'getLawyers']);
        Route::post('/lawyer/{id}', [App\Http\Controllers\Supervisor\LawyerController::class, 'show']);
        Route::post('/lawyer/update/{id}', [App\Http\Controllers\Supervisor\LawyerController::class, 'update']);
        Route::post('/lawyer/register', [App\Http\Controllers\Supervisor\LawyerController::class, 'register']);
        Route::post('/lawyer/delete/{id}', [App\Http\Controllers\Supervisor\LawyerController::class, 'destroy']);
        
        Route::get('/clients', [App\Http\Controllers\Supervisor\SupervisorController::class, 'getClients']);
        Route::post('/client/register', [App\Http\Controllers\Supervisor\ClientController::class, 'register']);

        //Note
        Route::get('/note', [App\Http\Controllers\Supervisor\NoteController::class, 'index']);
        Route::post('/note/create', [App\Http\Controllers\Supervisor\NoteController::class, 'store']);
        Route::post('/note/update/{id}', [App\Http\Controllers\Supervisor\NoteController::class, 'update']);
        Route::post('/note/delete/{id}', [App\Http\Controllers\Supervisor\NoteController::class, 'destroy']);

        //Case Note
        Route::get('/case/index', [App\Http\Controllers\Supervisor\NoteCaseController::class, 'index']);
        Route::post('/case/{id}', [App\Http\Controllers\Supervisor\NoteCaseController::class, 'show']);
        Route::post('/case/create', [App\Http\Controllers\Supervisor\NoteCaseController::class, 'store']);
        Route::post('/case/update/{id}', [App\Http\Controllers\Supervisor\NoteCaseController::class, 'update']);
        Route::post('/case/delete/{id}', [App\Http\Controllers\Supervisor\NoteCaseController::class, 'destroy']);

    //Payment
        Route::get('/payment/index', [App\Http\Controllers\Supervisor\PaymentController::class, 'index']);
        Route::post('/payment/create', [App\Http\Controllers\Supervisor\PaymentController::class, 'store']);
        Route::post('/payment/update/{id}', [App\Http\Controllers\Supervisor\PaymentController::class, 'update']);
        Route::post('/payment/delete/{id}', [App\Http\Controllers\Supervisor\PaymentController::class, 'delete']);
    });

//for lawyer Role
Route::post('/v1/law/login', [LawyerController::class, 'login']);
Route::group(['prefix'=> 'v1', 'middleware'=> ['auth:lawyer']], function(){
        //  Route::get('/lawyers', [SupervisorController::class, 'getLawyers']);
         Route::get('/clients/supervisor/{id}', [App\Http\Controllers\Lawyer\SupervisorController::class, 'getClients']);
         Route::get('/note/supervisor/{id}', [App\Http\Controllers\Lawyer\NoteController::class, 'index']);
         Route::get('/case/supervisor/{id}', [App\Http\Controllers\Lawyer\NoteCaseController::class, 'index']);
    });

 //for client Role
  Route::post('/v1/client/login', [ClientController::class, 'login']);
      Route::group(['prefix'=> 'v1', 'middleware'=> ['auth:client']], function(){
      Route::get('/lawyers/supervisor/{id}', [App\Http\Controllers\Client\SupervisorController::class, 'getLawyers']);
       
 //  Route::get('/clients', [SupervisorController::class, 'getClients']);
    Route::get('/note/supervisor/{id}', [App\Http\Controllers\Client\NoteController::class, 'index']);
    Route::get('/case/supervisor/{id}', [App\Http\Controllers\Client\NoteCaseController::class, 'index']);
    });