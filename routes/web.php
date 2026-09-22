<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SmartBridgeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Smart Redirect Bridge (ShopeeFood, GrabFood, GoFood)
Route::get('/bridge/{platform}/{outlet?}', [SmartBridgeController::class, 'show'])->name('bridge.show');
Route::get('/pesan/{platform}/{outlet?}', [SmartBridgeController::class, 'show'])->name('bridge.pesan');
Route::get('/bridge-go/{platform}/{outlet?}', [SmartBridgeController::class, 'redirect'])->name('bridge.redirect');
Route::get('/bridge-stats', [SmartBridgeController::class, 'stats'])->name('bridge.stats');

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{orderNumber}', [OrderController::class, 'show'])->name('orders.show');
Route::post('/orders/{orderNumber}/simulate-payment', [OrderController::class, 'simulatePayment'])->name('orders.simulate-payment');
Route::post('/orders/{orderNumber}/simulate-status', [OrderController::class, 'simulateStatus'])->name('orders.simulate-status');

