<?php

use App\Http\Controllers\Home\HomeController;
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

Route::prefix('/')->name('home')->group(function () {
    Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
    Route::get('/tt/{cp_code}', [HomeController::class, 'index'])->name('index');
    Route::get('/backurl', [HomeController::class, 'backLog'])->name('backurl');
    Route::get('/showheader', [HomeController::class, 'showHeader'])->name('showHeader');

    Route::post('/log', [HomeController::class, 'logRequest'])->name('log');
});
