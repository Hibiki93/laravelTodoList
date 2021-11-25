<?php

use App\Http\Controllers\TodolistController;
use App\Http\Controllers\MainController;
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

Route::get('/',[TodolistController::class, 'index'])->name('index');
Route::post('/',[TodolistController::class, 'store'])->name('store');
Route::delete('/{todolist:id}',[TodolistController::class, 'destroy'])->name('destroy');

// Route::get('/',[TodolistController::class, 'index'])->name('index');

Route::get('/login',[MainController::class, 'index'])->name('login')->middleware('alreadyLoggedIn');
Route::post('/checklogin',[MainController::class, 'checklogin'])->name('checklogin');
Route::get('/login/successlogin',[MainController::class, 'successlogin'])->name('successlogin');
Route::get('/logout',[MainController::class, 'logout'])->name('logout');
Route::post('/registerAccount',[MainController::class, 'register'])->name('register');
Route::get('/registerAccount',[MainController::class, 'registration'])->name('registration')->middleware('alreadyLoggedIn');
