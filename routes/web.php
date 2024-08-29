<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('inicio');
});


Route::get('/compraapi', [ProductController::class, 'indexApi'])->name('compra.api');
Route::get('/compralocal', [ProductController::class, 'indexLocal'])->name('compra.local');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/checkout/{id}', [StripePaymentController::class, 'checkoutSingle'])->name('stripe.checkout.single');
    Route::post('/checkoutall', [StripePaymentController::class, 'checkoutAll'])->name('stripe.checkout.all');

    Route::get('/successapi', [StripePaymentController::class, 'successApi'])->name('payment.successapi');
    Route::get('/cancel', [StripePaymentController::class, 'cancel'])->name('payment.cancel');

    Route::get('/successlocal', [StripePaymentController::class, 'successLocal'])->name('payment.successlocal');

    Route::post('/create-checkout-session-ajax/{id}', [StripePaymentController::class, 'createCheckoutSessionAjax'])->name('stripe.checkout.ajax');
});

require __DIR__ . '/auth.php';
