<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Superadmin',
                'username' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Staff',
                'username' => 'staff',
                'email' => 'staff@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maintenance',
                'username' => 'maintenance',
                'email' => 'maintenance@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'role_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Technician',
                'username' => 'technician',
                'email' => 'tech@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'role_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'name' => 'Salma Dewi Nurhabibah',
            //     'username' => 'salmadewi',
            //     'email' => 'salmadewinurhabibah20@gmail.com',
            //     'email_verified_at' => now(),
            //     'password' => Hash::make('salma123'),
            //     'role_id' => 3,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ];

        DB::table('users')->insert($users);
    }
}
