<?php

use App\Http\Controllers\WorkController;
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

Route::view('students','livewire.students_home');

Route::get('mvp',[WorkController::class,'mvp']);
Route::get('ranks',[WorkController::class,'ranks']);
Route::get('orders',[WorkController::class,'orders']);
