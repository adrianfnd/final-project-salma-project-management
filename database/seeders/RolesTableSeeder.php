<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Superadmin',
            'Staff',
            'Maintenance',
            'Technician',
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'role_name' => $role,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
