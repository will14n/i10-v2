<?php

use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\NoticeController;
use Illuminate\Support\Facades\Route;

Route::get('/notice/list', [NoticeController::class, 'list'])->name('notice.list');
Route::get('/notice/create', [NoticeController::class, 'create'])->name('notice.create');
Route::get('/', [NoticeController::class, 'index'])->name('home');
Route::get('/notice', [NoticeController::class, 'index'])->name('notice.index');
// Route::get('/notice/{filter?}', [NoticeController::class, 'index'])->name('notice.filter');
Route::post('/notice', [NoticeController::class, 'store'])->name('notice.store');
Route::get('/notice/{id}', [NoticeController::class, 'show'])->name('notice.show');
Route::get('/notice/{id}/edit', [NoticeController::class, 'edit'])->name('notice.edit');
Route::put('/notice/{id}', [NoticeController::class, 'update'])->name('notice.update');
Route::delete('/notice/{id}', [NoticeController::class, 'destroy'])->name('notice.destroy');

Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');

Route::get('/api-routes', [NoticeController::class, 'showApiRoutes'])->name('api.routes');
