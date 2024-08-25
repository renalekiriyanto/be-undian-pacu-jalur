<?php

use App\Livewire\Jalurindex;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('jalur')->group(function () {
    Route::get('/', Jalurindex::class);
});
