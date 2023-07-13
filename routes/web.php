<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BkashController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Payment
Route::get('/bkash/pay', [BkashController::class, 'payment'])->name('url-pay');
Route::post('/bkash/create', [BkashController::class, 'createPayment'])->name('url-payment-create');
Route::get('/bkash/callback', [BkashController::class, 'callbackPayment'])->name('url-payment-callback');

// Agreement
Route::post('/bkash/agreement/create', [BkashController::class, 'createAgreement'])->name('url-agreement-create');
Route::get('/bkash/agreement/callback', [BkashController::class, 'callbackAgreement'])->name('url-agreement-callback');
Route::post('/bkash/agreement/cancel', [BkashController::class, 'cancelAgreement'])->name('url-agreement-cancel');

// Refund
Route::get('/bkash/refund', [BkashController::class, 'getRefund'])->name('url-get-refund');
Route::post('/bkash/refund', [BkashController::class, 'refundPayment'])->name('url-post-refund');
