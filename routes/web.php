<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HeroSectionController;
use App\Http\Controllers\Api\HotelBookingSectionController;
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\Api\FacilityController;
use App\Http\Controllers\Api\AboutFacilityContentController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\AboutSaputaraController;
use App\Http\Controllers\Api\FestivalGalleryController;
use App\Http\Controllers\Api\ContactInfoController;



Route::prefix('/api')->group(function () {
    Route::get('/hero-sections', [HeroSectionController::class, 'index']);
    Route::get('/hotel-booking-section', [HotelBookingSectionController::class, 'index']);
    Route::get('/videos', [VideoController::class, 'index']);
    Route::get('/facilities', [FacilityController::class, 'index']);
    Route::get('/facilities/{id}', [FacilityController::class, 'show']);
    Route::get('/about-facilities-content', [AboutFacilityContentController::class, 'index']);
    Route::get('/gallery', [GalleryController::class, 'index']);
    Route::get('/about-saputara', [AboutSaputaraController::class, 'index']);
    Route::get('/about-saputara/{section}', [AboutSaputaraController::class, 'show'])
        ->where('section', 'about|sightseeing|testimonials|gallery');
    Route::get('/festival-gallery', [FestivalGalleryController::class, 'index']);
    Route::get('/festival-gallery/category/{categoryId}', [FestivalGalleryController::class, 'byCategory']);
    Route::get('/contact', [ContactInfoController::class, 'index']);
});
