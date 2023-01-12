<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mainpage;
use App\Http\Controllers\UserManagement;
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

// Routes pour le controller "Mainpage"

Route::get('/home', [Mainpage::class, 'home'])->middleware('auth');

Route::post('/createworkspace', [Mainpage::class, 'createWorkspace']);

Route::post('/deleteworkspace/{id}', [Mainpage::class, 'deleteWorkspace']);

Route::get('/editworkspace/{id}', [Mainpage::class, 'editWorkspace']);

Route::post('/posteditworkspace/{id}', [Mainpage::class, 'postEditWorkspace']);

Route::get('/managemembers/{id}', [UserManagement::class, 'manageMembers']);

Route::post('/managemembers/{id}', [UserManagement::class, 'postManageMembers']);

Route::post('/addusertoworkspace/{id}', [UserManagement::class, 'addUserToWorkspace']);

Route::post('/removeuserfromworkspace/{id}/{listeduserid}/{currentuser}', [UserManagement::class, 'removeUserFromWorkspace']);

Route::post('/transferownership/{id}/{listeduserid}/{currentuser}', [UserManagement::class, 'transferOwnership']);

Route::get('/workspace/{id}', [Mainpage::class, 'accessWorkspace']);

// Routes pour le controller "Tasks"

Route::post('/createtask/{workspaceid}', [Tasks::class, 'createtask']);

Route::post('/delete/{id}', [Tasks::class, 'delete']);

Route::get('/edit/{id}', [Tasks::class, 'edit']);

Route::post('/edit/{id}', [Tasks::class, 'editid']);