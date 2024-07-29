<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'CB1' => 'Type for CB1',
            'CB2' => 'Type for CB2',
            'CB3' => 'Type for CB3',
            'TK1' => 'Type for TK1',
            'TK2' => 'Type for TK2',
            'TK3' => 'Type for TK3',
            'TK4' => 'Type for TK4',
            'SI' => 'Type for SI',
            'POC' => 'Type for POC',
            'JI' => 'Type for JI',
        ];

        foreach ($types as $type => $description) {
            DB::table('types')->insert([
                'type_name' => $type,
                'description' => $description,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
