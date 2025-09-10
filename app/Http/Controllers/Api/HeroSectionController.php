<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
{
    public function index()
    {
        $heroSections = HeroSection::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();
            
        return response()->json($heroSections);
    }
}