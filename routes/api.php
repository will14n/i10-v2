<?php

use App\Http\Controllers\Api\NoticeController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/notice/paginated', [NoticeController::class, 'indexPaginated'])->name('notice.paginated');
Route::apiResource('/notice', NoticeController::class);
// Route::get('/notice/paginated/{page}', [NoticeController::class, 'indexPaginated'])->name('notice.paginated');

// Route::apiResource('/category', CategoryController::class);
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::patch('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
