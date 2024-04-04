<?php

use App\Http\Controllers\Admin\{SupportController};
use App\Http\Controllers\Estudos\ArrayController;
use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Address\AddressController;

Route::get('/addresses/{cep}', [AddressController::class, 'getOrCreate'])->name('addresses.show');
Route::get('addresses', [AddressController::class, 'getAll'])->name('addresses.list');


Route::get('/arrays', [ArrayController::class, 'simpleArray'])->name('arrays.index');


Route::delete('/supports/{id}', [SupportController::class, 'destroy'])->name('supports.destroy');
Route::put('/supports/{id}', [SupportController::class, 'update'])->name('supports.update');
Route::get('/supports/{id}/edit', [SupportController::class, 'edit'])->name('supports.edit');
Route::get('/supports/create', [SupportController::class, 'create'])->name('supports.create');
Route::get('/supports/{id}', [SupportController::class, 'show'])->name('supports.show');
Route::post('/supports', [SupportController::class, 'store'])->name('supports.store');
Route::get('/supports', [SupportController::class, 'index'])->name('supports.index');

Route::get('/contato', [SiteController::class, 'contact']);

Route::get('/', function () {
    return view('welcome');
});
