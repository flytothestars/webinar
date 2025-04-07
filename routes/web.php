<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StreamController;

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

// Route::get('/stream', function () {
//     return view('stream');
// });

Route::get('/webinar/stream/{webinar_id}', [StreamController::class, 'index'])->name('webinar.stream');