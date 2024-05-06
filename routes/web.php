<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

Route::get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');


Route::get('/equipements', [EquipementController::class, 'index'])->name('equipements.index');
Route::get('/equipements/create', [EquipementController::class, 'create'])->name('equipements.create');
Route::post('/equipements/store', [EquipementController::class, 'store'])->name('equipements.store');
Route::delete('/equipements/{equipement}', [EquipementController::class, 'destroy'])->name('equipements.destroy');
Route::post('/equipements/{equipement}/reserve', [EquipementController::class, 'reserve'])->name('equipements.reserve');
Route::get('/equipements/{equipement}/edit', [EquipementController::class, 'edit'])->name('equipements.edit');
Route::put('/equipements/{equipement}', [EquipementController::class, 'update'])->name('equipements.update');
Route::delete('/images/{id}', [EquipementController::class, 'destroyImage'])->name('images.destroy');
Route::get('/equipements/{equipement}', [EquipementController::class, 'show'])->name('equipements.show');

Route::get('/projets', [ProjetController::class, 'index'])->name('projets.index');
Route::get('/projets/create', [ProjetController::class, 'create'])->name('projets.create');
Route::post('/projets', [ProjetController::class, 'store'])->name('projets.store');
Route::delete('/projets/{projet}', [ProjetController::class, 'destroy'])->name('projets.destroy');
Route::get('/projets/{projet}', [ProjetController::class, 'show'])->name('projets.show');
Route::get('/projets/{projet}/edit', [ProjetController::class, 'edit'])->name('projets.edit');
Route::put('/projets/{projet}', [ProjetController::class, 'update'])->name('projets.update');
Route::get('/projets/{id}/details', [ProjetController::class, 'details'])->name('projets.details');


Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('/reservations/create/{equipementId?}', [ReservationController::class, 'create'])->name('reservations.create');

Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');


Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');



Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


    Route::post('/reservations/{reservation}/accept', [ReservationController::class,'accept'])->name('reservations.accept');
    Route::post('/reservations/{reservation}/reject', [ReservationController::class,'reject'])->name('reservations.reject');

    Route::get('/reservations/{reservation}/accept', [ReservationController::class, 'showAcceptForm'])->name('reservations.showAccept');
    Route::get('/reservations/{reservation}/reject', [ReservationController::class, 'showRejectForm'])->name('reservations.showReject');


    Route::get('/users', [UserController::class, 'listUsers'])->name('users.list');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
   
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');



Route::get('/contact', function () {
    return view('contact.index');
})->name('contact');


Route::get('change-password', [AuthController::class, 'showChangePasswordForm'])->name('change.password.form');
Route::post('change-password', [AuthController::class, 'changePassword'])->name('change.password');

Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('updateProfile');
Route::post('/upload-profile-image', [AuthController::class, 'uploadProfileImage'])->name('upload.profile.image');

