<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/midtrans-callback', [OrderController::class, 'callback']);
