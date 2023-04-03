<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasisController;
use App\Http\Controllers\NutrientsController;

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

Route::get('/food', [BasisController::class, 'index'])->name('food.index');
Route::post('/nutrients', [NutrientsController::class, 'store'])->name('food.store');
Route::get('/nutrients', [NutrientsController::class, 'index'])->name('nutrients.index');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
