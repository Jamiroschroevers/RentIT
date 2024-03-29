<?php

use App\Http\Controllers\MalfunctionController;
use App\Http\Controllers\MalfunctionHandlingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkorderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TenantController;

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
    Route::get('/workorder', [WorkorderController::class, 'index'])->name('workorder.index');
    Route::post('/workorder/{workorder}', [WorkorderController::class, 'store'])->name('workorder.store');
    Route::get('/workorder/show/{workorder}', [WorkorderController::class, 'show']);
    Route::get('/tenant/show/{tenant}', [TenantController::class, 'show'])->name('tenant.show');
    Route::get('/tenant/{property}', [TenantController::class, 'create'])->name('tenant.create');
    Route::post('/tenant/{property}', [TenantController::class, 'store'])->name('tenant.store');
    Route::get('/get-address/{postcode}', [PropertyController::class, 'getAddress']);
    Route::post('/save_property/{property}', [PropertyController::class, 'save_property']);

    //admin and monteur
    Route::middleware('MonteurAdmin')->group(function () {
        Route::get('AStoring', [MalfunctionController::class, 'indexAdmin'])->name('Astoring.index');
        Route::post('AStoring/{malfunction}', [MalfunctionController::class, 'storeAdmin'])->name('Astoring.store');
        Route::put('AStoring/{malfunction}', [MalfunctionController::class, 'updateAdmin'])->name('Astoring.update');
        Route::get('StoringAfhandelen/{malfunction}', [MalfunctionHandlingController::class, 'create'])->name('StoringH.create');
        Route::post('StoringAfhandelen/{malfunction}', [MalfunctionHandlingController::class, 'store'])->name('StoringH.store');
        Route::put('StoringAfhandelen/{malfunctionHandling}', [MalfunctionHandlingController::class, 'update'])->name('StoringH.update');
    });
});

Route::resource('/Hstoring', MalfunctionController::class);

require __DIR__ . '/auth.php';
