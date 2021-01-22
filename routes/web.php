<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('products', 'App\Http\Controllers\ProductController');
Route::get('/products.search', 'App\Http\Controllers\ProductController@search');

Route::resource('recipes', 'App\Http\Controllers\RecipeController');

Route::get('questions', function () {
    return view('Questions.first');
});
Route::resource('CreateQuestion', 'App\Http\Controllers\QuestionController');
