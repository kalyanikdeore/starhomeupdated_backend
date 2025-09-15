<?php

        use Illuminate\Support\Facades\Route;
        use App\Http\Controllers\Api\HeroSectionController;
        use App\Http\Controllers\Api\HotelBookingSectionController;
        use App\Http\Controllers\Api\VideoSectionController;
        use App\Http\Controllers\Api\TestimonialController;
        use App\Http\Controllers\Api\AboutUsController;
        use App\Http\Controllers\Api\RestaurantGalleryController;
        use App\Http\Controllers\Api\StayReasonController;
        use App\Http\Controllers\Api\HotelStatisticsController;
        use App\Http\Controllers\Api\AboutSectionController;
        use App\Http\Controllers\Api\ResortVideoController;
        use App\Http\Controllers\Api\AboutResortController;
        use App\Http\Controllers\Api\CtaSectionController;
        use App\Http\Controllers\Api\RestaurantSectionController;





        Route::prefix('/api')->controller(HomeController::class)->group(function () { 
        Route::get('/hero-sections', [HeroSectionController::class, 'index']);
        Route::get('/hotel-booking-section', [HotelBookingSectionController::class, 'index']);
        Route::get('/video-section', [VideoSectionController::class, 'showActive']);
        Route::get('/testimonials', [TestimonialController::class, 'index']);
        Route::get('/about-us', [AboutUsController::class, 'index']);
        Route::get('restaurant-gallery', [RestaurantGalleryController::class, 'index']);
        Route::get('stay-reasons', [StayReasonController::class, 'index']);
        Route::get('/hotel-statistics', [HotelStatisticsController::class, 'index']);
        Route::get('/about-sections', [AboutSectionController::class, 'index']);
        Route::get('resort-video', [ResortVideoController::class, 'show']);
        Route::get('/about-resort', [AboutResortController::class, 'index']);
        Route::get('/cta-section', [CtaSectionController::class, 'showActive']);
        Route::get('/restaurant-section', [RestaurantSectionController::class, 'index']);
        

});
