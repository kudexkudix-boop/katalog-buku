<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

// Route::get('/', function () {
//     return view('welcome');
// });

route::view('/profil-kelas','profil-kelas')
->name('profil-kelas');

//p2
Route::get('/books', [BookController::class, 'index'])
 ->name('books.index');

Route::get('/books/{id}', [BookController::class,'show'])
->whereNumber('id')
->name('books.show');

//p4
Route::view('/','books.home')->name('home');

Route::resource('books', BookController::class);
