<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;

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
    return view('welcome');
});

//การสร้าง Route
Route::get('/about/asdadadds', [AboutController::class, 'index'])->name('about');
Route::get('/admin/asdadadds', [AdminController::class, 'index'])->name('admin');
Route::get('/member/asdadadds', [MemberController::class, 'index']);