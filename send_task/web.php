<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/tasks/new/{name}', function($name) {
    $task = new Task;
    $task->name = $name;
    $task->status = 0;
    $task->save();
    $arr = [
        'state'=>'ok',
    ];
    $string_json = json_encode($arr);
    echo "<pre>";
    echo $string_json;
});

Route::get('/api/tasks/all', function() {
    $arr = Task::all();
    $string_json = json_encode($arr);
    echo "<pre>";
    echo $string_json;
});

Route::get('/api/tasks/show/{id}', function($id) {
    $task = Task::find($id);
    $string_json = json_encode($task);
    echo "<pre>";
    echo $string_json;
});

Route::get('/api/tasks/delete/{id}', function($id) {
    Task::destroy($id);
    $arr = [
        'state'=>'ok',
    ];
    $string_json = json_encode($arr);
    echo "<pre>";
    echo $string_json;
});