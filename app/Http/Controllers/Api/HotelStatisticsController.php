<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HotelStatistic;
use Illuminate\Http\Request;

class HotelStatisticsController extends Controller
{
    public function index()
    {
        $stats = HotelStatistic::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get()
            ->map(function ($stat) {
                return [
                    'number' => (float) $stat->number,
                    'label' => $stat->label,
                    'suffix' => $stat->suffix,
                    'decimals' => (int) $stat->decimals,
                ];
            });

        return response()->json($stats);
    }
}