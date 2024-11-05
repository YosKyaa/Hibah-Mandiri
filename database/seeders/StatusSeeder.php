<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            ['id' => 'S00', 'status' => 'Draf','color' => 'warning'],
            ['id' => 'S01', 'status' => 'Pengajuan','color' => 'info'],
            ['id' => 'S02', 'status' => 'Menunggu review','color' => 'warning'],
            ['id' => 'S03', 'status' => 'Menunggu Review Revisi','color'=>'success'],
            ['id' => 'S04', 'status' => 'Revisi','color'=>'secondary'],
            ['id' => 'S05', 'status' => 'Pengajuan ditolak' ,'color' => 'danger'],
            ['id' => 'S06', 'status' => 'Pengajuan disetujui' ,'color' => 'success'],
            ['id' => 'S07', 'status' => 'Pencairan Dana Tahap 1','color' => 'info'],
            ['id' => 'S08', 'status' => 'Pencairan Dana Tahap 2','color' => 'info'],
            ['id' => 'S09', 'status' => 'Pencairan Dana Tahap 1 Telah diterima','color' => 'success'],
            ['id' => 'S10', 'status' => 'Pencairan Dana Tahap 2 Telah diterima','color' => 'success'],
            // ['id' => 'S11', 'status' => '','color' => 'dark'],
            // ['id' => 'S11', 'status' => 'Presentasi','color' => 'dark'],
        ];

        foreach ($data as $item) {
            DB::table('statuses')->insert([
                'id' => $item['id'],
                'status' => $item['status'],
                'color' => $item['color'],
            ]);
        }
    }
}

