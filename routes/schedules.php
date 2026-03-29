<?php

use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Schedule Routes
|--------------------------------------------------------------------------
| Add these two lines inside your routes/web.php file.
| Both are wrapped in auth middleware so only logged-in users can access them.
*/

Route::middleware(['auth'])->group(function () {

    // Show the upload form
    Route::get('/schedules', [ScheduleController::class, 'index'])
         ->name('schedules.index');

    // Handle PDF upload
    Route::post('/schedules/upload', [ScheduleController::class, 'upload'])
         ->name('schedules.upload');

});
