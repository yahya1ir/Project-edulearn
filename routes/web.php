<?php

use App\Http\Controllers\AccController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;

// Login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->middleware('role')->name('register');
Route::get('/dash', [AuthController::class, 'dash'])
    ->middleware('role')  
    ->name('dashboard');

Route::get('/absence', [AccController::class, 'absc'])->name('absence');



Route::post('/auth/register', [AuthController::class, 'registerPost'])->name('register.post'); 
Route::post('/auth/login', [AuthController::class, 'loginPost'])->name('login.post'); 







Route::delete('/delete/{id}', [AccController::class, 'delete'])->name('delete');

Route::post('/absence/{email}', [AccController::class, 'toggle'])->name('absence.toggle');












//
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {

    // Admin 
    Route::get('/admin', [AccController::class, 'admin'])
        ->name('admin')
        ->middleware('role:admin');

    // Student 
    Route::get('/student', [AccController::class, 'student'])
        ->name('student')
        ->middleware('role:student');

    // Formateur 
    Route::get('/formateur', [AccController::class, 'prof'])
        ->name('formateur')
        ->middleware('role:formateur');
});






Route::POST('/logout', [AuthController::class, 'login'])->name('logout');


