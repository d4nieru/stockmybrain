<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mainpage;

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

Route::post('/createworkspace', [Mainpage::class, 'createWorkspace']);

Route::post('/deleteworkspace/{id}', [Mainpage::class, 'deleteWorkspace']);

Route::get('/editworkspace/{id}', [Mainpage::class, 'editWorkspace']);

Route::post('/posteditworkspace/{id}', [Mainpage::class, 'postEditWorkspace']);

Route::get('/managemembers/{id}', [Mainpage::class, 'manageMembers']);

Route::post('/managemembers/{id}', [Mainpage::class, 'postManageMembers']);

Route::post('/addusertoworkspace/{id}', [Mainpage::class, 'addUserToWorkspace']);

Route::post('/removeuserfromworkspace/{id}/{userid}', [Mainpage::class, 'removeUserFromWorkspace']);