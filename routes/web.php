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
    Route::group(['prefix'=>'users'],function (){
        Route::get('/',[UserController::class,'index'])->name('users.index');
        Route::get('/create',[UserController::class,'create'])->name('users.create');
        Route::post('/store',[UserController::class,'store'])->name('users.store');
        Route::get('/edit/{id}',[UserController::class,'edit'])->name('users.edit');
        Route::put('/update/{id}',[UserController::class,'update'])->name('users.update');
        Route::delete('/{id}',[UserController::class,'delete'])->name('users.delete');

    });

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
