<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SbusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sbus = [
            ['sbu_name' => 'SBU Palembang', 'location' => 'Palembang', 'latitude' => -2.990934, 'longitude' => 104.756555],
            ['sbu_name' => 'SBU Denpasar', 'location' => 'Denpasar', 'latitude' => -8.670458, 'longitude' => 115.212629],
            ['sbu_name' => 'SBU Medan', 'location' => 'Medan', 'latitude' => 3.595196, 'longitude' => 98.672223],
            ['sbu_name' => 'SBU Pekanbaru', 'location' => 'Pekanbaru', 'latitude' => 0.533203, 'longitude' => 101.450041],
            ['sbu_name' => 'SBU Makasar', 'location' => 'Makasar', 'latitude' => -5.147665, 'longitude' => 119.432731],
            ['sbu_name' => 'SBU Surabaya', 'location' => 'Surabaya', 'latitude' => -7.257472, 'longitude' => 112.752088],
            ['sbu_name' => 'SBU Bandung', 'location' => 'Bandung', 'latitude' => -6.917464, 'longitude' => 107.619123],
            ['sbu_name' => 'SBU Balikpapan', 'location' => 'Balikpapan', 'latitude' => -1.269160, 'longitude' => 116.831123],
            ['sbu_name' => 'SBU Jakban', 'location' => 'Jakarta Barat', 'latitude' => -6.176654, 'longitude' => 106.791960],
            ['sbu_name' => 'SBU Semarang', 'location' => 'Semarang', 'latitude' => -6.966667, 'longitude' => 110.416664],
        ];

        foreach ($sbus as $sbu) {
            DB::table('sbus')->insert([
                'sbu_name' => $sbu['sbu_name'],
                'location' => $sbu['location'],
                'latitude' => $sbu['latitude'],
                'longitude' => $sbu['longitude'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
