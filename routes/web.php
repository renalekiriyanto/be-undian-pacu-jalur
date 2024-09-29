<?php

use App\Livewire\ArenaCreate;
use App\Livewire\ArenaEdit;
use App\Livewire\ArenaIndex;
use App\Livewire\DaerahList;
use App\Livewire\JalurCreate;
use App\Livewire\JalurEdit;
use App\Livewire\Jalurindex;
use App\Livewire\LotteryCreate;
use App\Livewire\LotteryEdit;
use App\Livewire\LotteryIndex;
use App\Livewire\MatchCreate;
use App\Livewire\MatchIndex;
use Illuminate\Support\Facades\Route;
use Monolog\Handler\RotatingFileHandler;

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
    Route::get('/', ArenaIndex::class)->name('list');
    Route::get('/add', ArenaCreate::class)->name('add');
    Route::get('/edit/{id}', ArenaEdit::class)->name('edit');
});
Route::group(['prefix' => 'lottery', 'as' => 'lottery.'], function () {
    Route::get('/', LotteryIndex::class)->name('list');
    Route::get('/add', LotteryCreate::class)->name('add');
    Route::get('/edit/{id}', LotteryEdit::class)->name('edit');
});

Route::group(['prefix' => 'match', 'as' => 'match.'], function () {
    Route::get('/', MatchIndex::class)->name('list');
    Route::get('/add', MatchCreate::class)->name('add');
    // Route::get('/edit/{id}', MatchEdit::class)->name('edit');
});
