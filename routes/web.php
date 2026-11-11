<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookController;

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

use Illuminate\Support\Facades\DB;


Route::get('/db-test', function () {
    try {
        DB::connection()->getPdo();
        $dbName = DB::connection()->getDatabaseName();
        $version = DB::select('SELECT VERSION() as version')[0]->version;

        return response()->json([
            'status' => 'success',
            'message' => "Успешное подключение к базе данных: {$dbName}",
            'server_version' => $version,
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Не удалось подключиться к БД: ' . $e->getMessage(),
        ], 500);
    }
});
