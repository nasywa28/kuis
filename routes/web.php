<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::resource('/posts', \App\Http\Controllers\PostController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin-page',[App\Http\Controllers\HomeController::class, 'indexAdmin'])->middleware('role:admin')->name('admin.page');
Route::get('user-page', [App\Http\Controllers\HomeController::class, 'indexUser'])->middleware('role:user')->name('user.page');
