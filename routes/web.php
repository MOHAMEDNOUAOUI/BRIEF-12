<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PostsController;

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

Route::get('/', [PostsController::class,'index'])->name('home');
Route::post('/timefilter', [PostsController::class, 'timefilter'])->name('timefilter');

Route::post('/filter-posts', [PostsController::class, 'filterPosts'])->name('filter-posts');



Route::post('/saverecits', [PostsController::class, 'saverecits'])->name('saverecits');

