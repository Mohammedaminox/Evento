<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ForgetPasswordManager;


use App\Http\Controllers\AcceptEventController;
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


Route::get('/forget-password', [ForgetPasswordManager::class, 'forgetPassword'])->name('forgetPassword');

Route::post('/forget-password', [ForgetPasswordManager::class, 'forgetPasswordPost'])->name('forgetPasswordPost');

Route::get('/reset-password{token}', [ForgetPasswordManager::class, 'resetPassword'])->name("resetPassword");

Route::post('/reset-password', [ForgetPasswordManager::class, 'resetPasswordPost'])->name("resetPasswordPost");



Route::view('/login', 'auth.form');
Route::view('/', 'auth.form');
Route::view('/dashboard', 'dashboard');



Route::resource('category', CategoryController::class)->only([
    'index', 'store', 'update', 'destroy'
]);

Route::resource('event', EventController::class)->only([
    'index', 'store', 'update', 'destroy'
]);

Route::get('/AcceptEvent', [AcceptEventController::class, 'Acceptindex'])->name('AcceptEvent');
Route::post('/AcceptEvent/{id}/edit', [AcceptEventController::class, 'Approuve'])->name('approuve');

Route::post('/Reservation', [ReservationController::class, 'store'])->name('reservation');


Route::post('/AcceptReservation', [ReservationController::class, 'AcceptReservation'])->name('AcceptReservation');

Route::post('/StatusReservation/{id}/accept', [ReservationController::class, 'StatusAccepted'])->name('StatusAccepted');
Route::post('/StatusReservation/{id}/refuse', [ReservationController::class, 'StatusRefused'])->name('StatusRefused');





// Route::get('/evento', function () {
//     return view('fontOffice.index');
// });
Route::get('/evento', [AcceptEventController::class, 'FrontIndex'])->name('FrontIndex');







// Route::get('/evento', [ReservationController::class, 'store'])->name('reservation');

Route::get('/emails', function () {
    return view('emails');
});
