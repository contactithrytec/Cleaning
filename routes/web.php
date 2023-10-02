<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResidenceController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ControllersController;

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
        Route::post('/store',[RoleController::class,'store'])->name('roles.store');
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
    Route::group(['prefix'=>'residences'],function (){
       Route::get('/',[ResidenceController::class,'index'])->name('residences.index');
       Route::get('/detail/{id}',[ResidenceController::class,'show'])->name('residences.show');
       Route::get('/show_controllers/{id}',[ResidenceController::class,'showControllers'])->name('residences.show_controllers');
       Route::post('/store',[ResidenceController::class,'store'])->name('residences.store');
       Route::put('/update/{id}',[ResidenceController::class,'update'])->name('residences.update');
       Route::delete('/{id}',[ResidenceController::class,'delete'])->name('residences.delete');
    });

    Route::group(['prefix'=>'apartments'],function (){
        Route::get('/',[ApartmentController::class,'index'])->name('apartments.index');
        Route::get('/create/{id}',[ApartmentController::class,'create'])->name('apartments.create');
        Route::post('/store',[ApartmentController::class,'store'])->name('apartments.store');
        Route::get('/edit/{id}',[ApartmentController::class,'edit'])->name('apartments.edit');
        Route::put('/update/{id}',[ApartmentController::class,'update'])->name('apartments.update');
        Route::delete('/{id}',[ApartmentController::class,'delete'])->name('apartments.delete');
    });

    Route::group(['prefix'=>'types'],function (){
        Route::get('/',[TypeController::class,'index'])->name('types.index');
        Route::post('/store',[TypeController::class,'store'])->name('types.store');
        Route::put('/update/{id}',[TypeController::class,'update'])->name('types.update');
        Route::delete('/{id}',[TypeController::class,'delete'])->name('types.delete');
    });

    Route::group(['prefix'=>'controllers'],function (){

        Route::get('/',[ControllersController::class,'index'])->name('controllers.index');
        Route::get('/create/{id}',[ControllersController::class,'create'])->name('controllers.create');
        Route::get('/edit/{id}',[ControllersController::class,'edit'])->name('controllers.edit');
        Route::delete('/{id}',[ControllersController::class,'delet'])->name('controllers.delete');

    });

  /*  Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);*/
});
