<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EggController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/rules', 'rules')->name('rules');
Route::get('/enigme/{code}', [EggController::class, 'show'])->name('egg.show');
