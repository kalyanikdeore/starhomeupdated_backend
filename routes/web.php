<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HeroSectionController;
use App\Http\Controllers\Api\HotelBookingSectionController;
use App\Http\Controllers\Api\VideoController;



Route::prefix('/api')->controller(HomeController::class)->group(function () { 
    Route::get('/hero-sections', [HeroSectionController::class, 'index']);
   Route::get('/hotel-booking-section', [HotelBookingSectionController::class, 'index']);
      Route::get('/videos', [VideoController::class, 'index']);
});
