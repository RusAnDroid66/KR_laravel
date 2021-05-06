<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\BookController;

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

Route::get('/', function(){
  return view('spa');
});

Route::post('/book/add', [BookController::class, 'add']);

Route::get('/book/all', [BookController::class, 'all']);

Route::get('/book/delete/{id}', [BookController::class, 'delete']);

Route::get('/book/change_availabilty/{id}', [BookController::class, 'changeAvailabilty']);

