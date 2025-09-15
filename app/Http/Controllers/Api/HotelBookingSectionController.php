<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HotelBookingSection;
use Illuminate\Http\Request;

class HotelBookingSectionController extends Controller
{
    public function index()
    {
        try {
            $section = HotelBookingSection::where('is_active', true)->first();
            
            if (!$section) {
                return response()->json([
                    'message' => 'No active hotel booking section found'
                ], 404);
            }

            return response()->json($section);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}