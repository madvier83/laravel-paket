<?php

use App\Http\Controllers\PaketController;
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

// Route::get('/', function () {
//     return view('main');
// });

Route::get('/', [PaketController::class, 'index']);
Route::post('/ongkir', [PaketController::class, 'measure']);
Route::post('/', [PaketController::class, 'store']);
Route::get('/histori', [PaketController::class, 'history']);