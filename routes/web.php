<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get("/machines","App\Http\Controllers\MachineController@index")->name("machines.index")->middleware("auth");

Route::get("/machines/create/","App\Http\Controllers\MachineController@create")->name("machines.create")->middleware("auth");
Route::post("/machines/store/","App\Http\Controllers\MachineController@store")->name("machines.store")->middleware("auth");

Route::get("/machines/edit/{machine}","App\Http\Controllers\MachineController@edit")->name("machines.edit")->middleware("auth");
Route::put("/machines/edit/{machine}","App\Http\Controllers\MachineController@update")->name("machines.update")->middleware("auth");

Route::get("/machines/show/{machine}","App\Http\Controllers\MachineController@show")->name("machines.show")->middleware("auth");

Route::delete("/machines/{machine}","App\Http\Controllers\MachineController@destroy")->name("machines.destroy")->middleware("auth");




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


