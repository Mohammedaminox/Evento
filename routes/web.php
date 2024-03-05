<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::view('/login', 'auth.form');
Route::view('/', 'auth.form');
Route::view('/dashboard', 'dashboard');



Route::resource('category', CategoryController::class)->only([
    'index', 'store', 'update', 'destroy'
]);

Route::resource('event', EventController::class)->only([
    'index', 'store', 'update', 'destroy'
]);






Route::get('/evento', function () {
    return view('fontOffice.index');
});
Route::get('/emails', function () {
    return view('emails');
});
