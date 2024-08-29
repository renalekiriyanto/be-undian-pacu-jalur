<?php

use App\Livewire\DaerahList;
use App\Livewire\Jalurindex;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('jalur')->group(function () {
    Route::get('/', Jalurindex::class);
});

Route::prefix('daerah')->group(function () {
    Route::get('/', DaerahList::class);
});
