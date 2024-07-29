<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'PENGAJUAN' => 'Status for PENGAJUAN',
            'SURAT JALAN CHECK' => 'Status for SURAT JALAN CHECK',
            'SURAT JALAN' => 'Status for SURAT JALAN',
            'INSTALASI' => 'Status for INSTALASI',
            'FINISHED' => 'Status for FINISHED',
            'CANCEL' => 'Status for CANCEL',
        ];

        // $statuses = [
        //     'BAPS' => 'Status for BAPS',
        //     'BASMP' => 'Status for BASMP',
        //     'CANCEL' => 'Status for CANCEL',
        //     'DELIVERY' => 'Status for DELIVERY',
        //     'DISMANTLE' => 'Status for DISMANTLE',
        //     'DRM' => 'Status for DRM',
        //     'FINISHED' => 'Status for FINISHED',
        //     'INSTALASI' => 'Status for INSTALASI',
        //     'KOM' => 'Status for KOM',
        //     'NEW' => 'Status for NEW',
        //     'ON PROGRESS' => 'Status for ON PROGRESS',
        //     'QC' => 'Status for QC',
        //     'UAT' => 'Status for UAT',
        // ];

        foreach ($statuses as $status => $description) {
            DB::table('statuses')->insert([
                'status_name' => $status,
                'description' => $description,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
