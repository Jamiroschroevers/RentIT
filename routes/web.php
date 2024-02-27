<?php

use App\Http\Controllers\MalfunctionController;
use App\Http\Controllers\ProfileController;
use App\Models\Malfunction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;

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

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/property', PropertyController::class);
    Route::get('/get-address/{postcode}', [PropertyController::class, 'getAddress']);
    Route::middleware('admin')->group(function () {
        Route::get('AStoring', [MalfunctionController::class, 'indexAdmin'])->name('Astoring.index');
    });
});

Route::resource('/Hstoring', MalfunctionController::class);

require __DIR__ . '/auth.php';
