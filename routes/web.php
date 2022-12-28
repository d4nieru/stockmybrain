<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mainpage;
use App\Http\Controllers\Tasks;

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

Route::get('/home', [Mainpage::class, 'home'])->middleware('auth');

Route::get('/formulaire', [Tasks::class, 'formulaire']);

Route::post('/createtask', [Tasks::class, 'createtask']);

Route::get('/liste', [Tasks::class, 'liste_task']);

// Route::get('/delete', [Tasks::class, 'delete']);

Route::post('/delete/{id}', [Tasks::class, 'delete']);

Route::get('/edit/{id}', [Tasks::class, 'edit']);

Route::post('/edit/{id}', [Tasks::class, 'editid']);