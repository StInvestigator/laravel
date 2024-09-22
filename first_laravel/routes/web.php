<?php

use App\Http\Controllers\InfoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');



Route::prefix("info")->as('info.')->group(function () {

    Route::get('/list/{pag?}',[ InfoController::class, 'index'])->name('index');
    Route::get('/create',[ InfoController::class, 'create'])->name('create');
    Route::get('/edit/{info}',[ InfoController::class, 'edit'])->name('edit');
    Route::get('/delete/{info}',[ InfoController::class, 'delete'])->name('delete');
    Route::get('/info/{info}',[ InfoController::class, 'info'])->name('info');
    Route::post('/store',[ InfoController::class, 'store'])->name('store');
    Route::post('/update/{prevInfo}',[ InfoController::class, 'update'])->name('update');

})->middleware(['auth']);


Route::get('/about-me', function () {
    return view('aboutMe');
})->name('aboutMe');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
