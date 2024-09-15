<?php

use App\Livewire\DaerahList;
use App\Livewire\JalurCreate;
use App\Livewire\JalurEdit;
use App\Livewire\Jalurindex;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::group(['prefix' => 'jalur', 'as' => 'jalur.'], function () {
    Route::get('/', Jalurindex::class)->name('list');
    Route::get('/add', JalurCreate::class)->name('add');
    Route::get('/edit/{id}', JalurEdit::class)->name('edit');
});

Route::group(['prefix' => 'daerah', 'as' => 'daerah.'], function () {
    Route::get('/', DaerahList::class)->name('list');
});

Route::group(['prefix' => 'arena', 'as' => 'arena.'], function () {
    Route::get('/', DaerahList::class)->name('list');
});
