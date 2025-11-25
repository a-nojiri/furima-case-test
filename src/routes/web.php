<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use 
Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use 
Laravel\Fortify\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ProfileController;

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


Route::get('/', [ItemController::class, 'index'])->name('items.index');

Route::get('/item/{item}',[ItemController::class, 'show'])->name('items.show');

Route::middleware('auth')->group(function () {
    Route::post('/item/{item}/like', [ItemController::class, 'like'])
        ->name('items.like');
    Route::post('/item/{item}/comments', [ItemController::class, 'storeComment'])
        ->name('items.comments.store');
    Route::get('/purchase/{item}',[PurchaseController::class, 'show'])->name('purchase.show');
    Route::post('/purchase/{item}', [PurchaseController::class, 'store'])
        ->name('purchase.store');
    Route::get('/mypage', [ProfileController::class, 'show'])
        ->name('mypage.show');    
});

Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => view('auth.login'))->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
        
    Route::get('/register', fn () => view('auth.register'))->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/purchase/{item}', [PurchaseController::class, 'show'])
        ->name('purchase.show');
});

