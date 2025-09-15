<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\AboutResort;
use Illuminate\Http\Request;

class AboutResortController extends Controller
{
    public function index()
    {
        $aboutResort = AboutResort::where('is_active', true)->first();
        
        if (!$aboutResort) {
            return response()->json(['message' => 'No active about section found'], 404);
        }
        
        return response()->json($aboutResort);
    }
}