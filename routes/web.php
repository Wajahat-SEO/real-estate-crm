<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PlotController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
 //   return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return redirect()->route('customers.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    
    // Same for Blocks
    Route::resource('blocks', BlockController::class);

    Route::get('/summary', [DashboardController::class, 'summary'])->name('dashboard.summary');


    // Same for plots
    Route::resource('plots', PlotController::class)->except(['show']);
    Route::resource('plots', PlotController::class);
    //gets plots on a specific block
    Route::get('get-plots/{block_id}', [PlotController::class, 'getPlots'])->name('get.plots');


    // And for installments
    // Route to show installments of a specific customer
    Route::get('installments/customer/{customer}', [InstallmentController::class, 'byCustomer'])->name('installments.byCustomer');

    // Route to show form to create installment for a customer
    Route::get('installments/create/{customer}', [InstallmentController::class, 'create'])->name('installments.create');

    // Route to store installment
    Route::post('installments', [InstallmentController::class, 'store'])->name('installments.store');

    // Edit, update, delete
    Route::get('installments/{installment}/edit', [InstallmentController::class, 'edit'])->name('installments.edit');
    Route::put('installments/{installment}', [InstallmentController::class, 'update'])->name('installments.update');
    Route::delete('installments/{installment}', [InstallmentController::class, 'destroy'])->name('installments.destroy');

});

require __DIR__.'/auth.php';
