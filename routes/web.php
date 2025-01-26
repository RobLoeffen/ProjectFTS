<?php

use App\Http\Controllers\BusController;
use App\Http\Controllers\CustomerListController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FestivalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('Festivals', FestivalController::class)
    ->middleware(['auth', 'verified', 'role:employee'])
    ->missing(function () {
        return redirect('Festivals');
    });

Route::delete('/customer-list/{customer}/{bus}', [CustomerListController::class, 'detachBus'])
    ->middleware(['auth', 'verified', 'role:employee'])
    ->name('CustomerList.detachBus')
    ->missing(function () {
        return redirect('CustomerList');
    });

Route::resource('CustomerList', CustomerListController::class)
    ->middleware(['auth', 'verified', 'role:employee'])
    ->missing(function () {
        return redirect('CustomerList');
    });

Route::resource('Buses', BusController::class)
    ->middleware(['auth', 'verified', 'role:employee'])
    ->missing(function () {
        return redirect('Buses');
    });

Route::get('/festivals', [FestivalController::class, 'paginate'])->name('festivals')
    ->middleware(['auth', 'verified']);

Route::get('/festivals/{Festival}/details', [FestivalController::class, 'show'])->name('festival.detail')
    ->middleware(['auth', 'verified'])
    ->missing(function () {
        return redirect()->route('festivals');
    });

Route::get('/ride/{bus}', [BusController::class, 'show'])->name('ride')
    ->middleware(['auth', 'verified']);

Route::post('/ride/{bus}/order', [BusController::class, 'link'])->name('ride-order')
    ->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
