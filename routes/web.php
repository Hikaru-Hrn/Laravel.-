<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

// Роуты для формы
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'handleForm'])->name('contact.handle');

// Роут для таблицы
Route::get('/contact/submission', [ContactController::class, 'listSubmissions'])->name('contact.submissions');

// CRUD книг
Route::resource('books', BookController::class);

// Тестовые роуты
Route::get('/greeting', [TestController::class, 'greeting']);
Route::get('/user/{id}', [TestController::class, 'showUser']);
Route::post('/submit-data', [TestController::class, 'submitData']);

// Базовая страничка
Route::get('/', [TestController::class, 'home']);
