<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Models\Attendance;
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

/*
Route::get('/attendance', function () {
    return view('user.attendance-register');
})->middleware('auth');
*/

// スタッフ用ログイン画面
Route::get('/login', function () {
    return view('user.user-login');
})->name('staff.login');

// スタッフ用登録画面
Route::get('/register', function () {
    return view('user.register');
})->name('staff.register');

// 管理者用ログイン画面
Route::get('/admin/login', function () {
    return view('admin.admin-login');
})->name('admin.admin-login');

//　認証済みスタッフのみ勤怠登録画面へアクセス可能
Route::middleware('auth')->group(function () {
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('user.attendance-register');
});

//　認証済み管理者のみ勤怠登録画面へアクセス可能
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/attendance/list', [AdminController::class, 'index'])->name('admin-attendance-list');
});

// ユーザログアウト画面
Route::get('/logout', function () {
    return view('user.user-login');
});
