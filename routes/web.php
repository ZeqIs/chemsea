<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\UserController;
use App\Models\Application;
use App\Models\Ticket;
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

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');;

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

Route::post('/user/authenticate', [UserController::class, 'authenticate']);

Route::get('/register', [UserController::class, 'create'])->middleware('guest');

Route::post('/users', [UserController::class, 'store']);

Route::get('/users/profile', [UserController::class, 'show'])->middleware('auth');

Route::get('/users/profile/edit', [UserController::class, 'edit'])->middleware('auth');

Route::put('/users/profile/update', [UserController::class, 'update'])->middleware('auth');

Route::get('/requests/{serviceRequest}/view', [ServiceRequestController::class, 'view'])->middleware('auth');

Route::get('/requests/{serviceRequest}/download', [ServiceRequestController::class, 'download'])->middleware('auth');

Route::post('/requests/{serviceRequest}/upload', [ServiceRequestController::class, 'upload'])->middleware('auth');

Route::get('/applications/create', [ApplicationController::class, 'create'])->middleware('auth');

Route::post('/applications/store', [ApplicationController::class, 'store'])->middleware('auth');

Route::get('/scientist/applications/{application}/review', [ApplicationController::class, 'review'])->middleware('auth');

Route::get('/applications/index', [ApplicationController::class, 'index'])->middleware('auth');

Route::get('/scientist/applications', [ApplicationController::class, 'scientistIndex'])->middleware('auth');

Route::get('/requests/index', [ServiceRequestController::class, 'index'])->middleware('auth');

Route::get('/scientist/requests', [ServiceRequestController::class, 'scientistIndex'])->middleware('auth');

Route::put('/applications/{application}/update/tracking', [ApplicationController::class, 'updateTracking'])->middleware('auth');

Route::put('/applications/{application}/update/appointment', [ApplicationController::class, 'updateAppointment'])->middleware('auth');

Route::get('/applications/{application}', [ApplicationController::class, 'show'])->middleware('auth');
