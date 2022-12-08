<?php

use App\Http\Controllers\AdminController;
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

Route::get('/', [AdminController::class, 'index']);
Route::post('/upload', [AdminController::class, 'store']);
Route::get('/download/{id}', [AdminController::class, 'download']);
Route::get('/delete/{id}', [AdminController::class, 'destroy']);
