<?php

use App\Http\Controllers\Api\PaymentWebhookController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\OutletController;
use Illuminate\Support\Facades\Route;

Route::get('/search', [SearchController::class, 'search']);
Route::get('/outlets/nearby', [OutletController::class, 'nearby']);
Route::post('/webhooks/payment', [PaymentWebhookController::class, 'handleWebhook']);
