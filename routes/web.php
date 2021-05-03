<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

if (env('APP_ENV') !== 'local') {
    URL::forceScheme('https');
}
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
    return redirect()->route('diary.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/diaries', [DiaryController::class, 'index'])->name('diary.index');

    Route::get('/diaries/create', [DiaryController::class, 'create'])->name('diary.create');
    Route::post('/diaries', [DiaryController::class, 'store'])->name('diary.store');

    Route::get('/diaries/{id}/edit', [DiaryController::class, 'edit'])->name('diary.edit');
    Route::post('/diaries/{id}', [DiaryController::class, 'update'])->name('diary.update');

    Route::get('/diaries/{id}/delete', [DiaryController::class, 'deleteConfirmation'])->name('diary.deleteConfirmation');
    Route::post('/diaries/{id}/delete', [DiaryController::class, 'delete'])->name('diary.delete');


    Route::get('/todos', [TodoController::class, 'index'])->name('todo.index');
    Route::post('/todos', [TodoController::class, 'store'])->name('todo.store');
    Route::post('/todos/save', [TodoController::class, 'update'])->name('todo.update');
});

Route::get('/about', [CommentController::class, 'index'])->name('about');
Route::post('/about', [CommentController::class, 'store'])->name('comment.store');

require __DIR__ . '/auth.php';
