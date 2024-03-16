<?php

use App\Http\Controllers\ChatBoxController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('chat/{id}', [ChatBoxController::class, 'show'])->name('chat');
    Route::post('add/{id}', [ChatBoxController::class, 'chat']);
    Route::get('home', [ChatBoxController::class, 'index'])->name('home');
});
