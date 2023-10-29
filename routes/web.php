<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
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
    return redirect()->to('/login');;
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user-info/{id}', [App\Http\Controllers\HomeController::class, 'getUser'])->name('getUser');
Route::post('/log-chat', [ChatController::class, 'logChatMessage']);
