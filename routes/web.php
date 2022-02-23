<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ServiceController;

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

    //Query Builder การดึงข้อมูลผ่าน DB โดยไม่ต้องสร้าง Model
    // $user=DB::table('users')->get();
    return view('dashboard', compact('user'));
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){

    //Department
    Route::get('/department/all', [DepartmentController::class, 'index'])->name('department');
    Route::post('/department/add', [DepartmentController::class, 'store'])->name('addDepartment');
    Route::get('department/edit/{id}', [DepartmentController::class, 'edit']);
    Route::post('department/update/{id}', [DepartmentController::class, 'update']);
    Route::get('department/sofedelete/{id}', [DepartmentController::class, 'sofedelete']);
    Route::get('department/restore/{id}', [DepartmentController::class, 'restore']);
    Route::get('department/delete/{id}', [DepartmentController::class, 'delete']);

    //Services
    Route::get('service/all', [ServiceController::class, 'index'])->name('services');
});

