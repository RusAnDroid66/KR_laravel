<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\VoteController;

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

Route::get('/', [VoteController::class, 'showAll']);

Route::get('/vote/create', function() {
  return view('create_vote');
});

Route::post('/vote/create', [VoteController::class, 'create']);

Route::get('/vote/show/{id}', [VoteController::class, 'showVote']);

Route::get('/vote/positive_inc/{id}', [VoteController::class, 'increasePositive']);

Route::get('/vote/negative_inc/{id}', [VoteController::class, 'increaseNegative']);