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
Route::get('/ordernew', [PostsController::class, 'ordernew'])->name('ordernew');
Route::get('/notordernow',[PostsController::class,'notordernow'])->name('notordernow');

Route::post('/filter_continent' , [PostsController::class,'filter_continent'])->name('filter-continent');



Route::post('/saverecits', [PostsController::class, 'saverecits'])->name('saverecits');

