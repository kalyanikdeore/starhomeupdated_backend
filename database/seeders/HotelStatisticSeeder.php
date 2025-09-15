<?php

namespace Database\Seeders;

use App\Models\HotelStatistic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelStatisticSeeder extends Seeder
{
    public function run()
    {
        $stats = [
            [
                'label' => 'Guest Stays',
                'number' => 25000,
                'suffix' => '+',
                'decimals' => 0,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'label' => 'Rooms Booked',
                'number' => 15000,
                'suffix' => '+',
                'decimals' => 0,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'label' => 'Meals Served',
                'number' => 25000,
                'suffix' => '+',
                'decimals' => 0,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'label' => 'Guest Rating',
                'number' => 4.9,
                'suffix' => '/5',
                'decimals' => 1,
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($stats as $stat) {
            HotelStatistic::create($stat);
        }
    }
}