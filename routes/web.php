<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Models\User;

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
})->name('home');

//การสร้าง Route
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('check');
Route::get('/member', [MemberController::class, 'index'])->name('member');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //value from model User
    $user=User::all();
    return view('dashboard', compact('user'));
})->name('dashboard');
