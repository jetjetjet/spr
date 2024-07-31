<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ControllingController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PrediksiController;

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

Route::get('/', [MonitoringController::class, 'index']);
Route::get('/controlling', [ControllingController::class, 'index']);
Route::get('/prediksi', [PrediksiController::class, 'index']);

