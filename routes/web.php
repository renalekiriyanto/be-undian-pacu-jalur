<?php

use App\Livewire\DaerahList;
use App\Livewire\JalurCreate;
use App\Livewire\JalurEdit;
use App\Livewire\Jalurindex;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('jalur')->group(function () {
    Route::get('/', Jalurindex::class)->name('list_jalur');
    Route::get('/add', JalurCreate::class)->name('add_jalur');
    Route::get('/edit/{id}', JalurEdit::class)->name('edit_jalur');
});

Route::prefix('daerah')->group(function () {
    Route::get('/', DaerahList::class);
});
