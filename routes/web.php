<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AwarenessContentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ManageContentController;
use App\Http\Controllers\Admin\ContentController as AdminContentController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/awareness-content', [AwarenessContentController::class, 'index'])->name('awareness.index');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'submit'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('/admin/manage-content', [ManageContentController::class, 'index'])->middleware('auth')->name('admin.manage-content');
Route::middleware('auth')->group(function () {
    Route::get('/admin/content', [AdminContentController::class, 'index'])->name('admin.content.index');
    Route::post('/admin/content', [AdminContentController::class, 'store'])->name('admin.content.store');
    Route::post('/admin/content/{content}', [AdminContentController::class, 'update'])->name('admin.content.update');
    Route::delete('/admin/content/{content}', [AdminContentController::class, 'destroy'])->name('admin.content.destroy');
});
