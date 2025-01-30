<?php

use App\Http\Controllers\ChatRoomController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\WeatherController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Todo app
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::put('/tasks/{id}', [TaskController::class, 'markAsDeleted'])->name('tasks.markAsDeleted');

Route::get('/tasks/trash', [TaskController::class, 'trash'])->name('tasks.trash');
Route::put('/tasks/{id}/recover', [TaskController::class, 'recover'])->name('tasks.recover');
Route::delete('/tasks/delete', [TaskController::class, 'deleteTrash'])->name('tasks.deleteTrash');

// Short URL App
Route::get('/urls', [UrlController::class, 'index'])->name('urls.index');
Route::post('/urls', [UrlController::class, 'store'])->name('urls.store');
Route::get('/urls/{shortUrl}', [UrlController::class, 'redirect'])->name('urls.redirect');

// Weather app
Route::get('/weather', [WeatherController::class, 'index'])->name('weather.index');

// News app
Route::get('/news', [NewsController::class, 'index'])->name('news.index');

// Chat app
Route::get('/chat_rooms', [ChatRoomController::class, 'index'])->name('chatRooms.index');
Route::post('/chat_rooms', [ChatRoomController::class, 'store'])->name('chatRooms.store');
Route::get('/chat_rooms/{chatRoom}', [ChatRoomController::class, 'show'])->name('chatRooms.show');
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
Route::get('/messages/{chatRoomId}', [MessageController::class, 'index'])->name('messages.index');