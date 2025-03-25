<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/book/{olid}', [BookController::class, 'show']);

Route::get('/books', [BookController::class, 'index']);
Route::get('/book/{olid}', [BookController::class, 'show']);
