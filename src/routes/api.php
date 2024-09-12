<?php

use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;


Route::apiResource('guests', GuestController::class);
