<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::group(['prefix'=>'roles'],function (){
        Route::get('/', [RoleController::class, 'index'])->name('roles.index');
        Route::post('/store',[RoleController::class,'create'])->name('roles.store');
        Route::put('/update/{id}',[RoleController::class,'update'])->name('roles.update');
        Route::delete('/{id}',[RoleController::class,'delete'])->name('roles.delete');
    });

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
