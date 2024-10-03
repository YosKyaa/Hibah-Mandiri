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
            ['id' => 'S03', 'status' => 'Rekomendasi','color'=>'success'],
            ['id' => 'S04', 'status' => 'Tidak Rekomendasi','color'=>'warning'],
            ['id' => 'S05', 'status' => 'Revisi','color'=>'secondary'],
            ['id' => 'S06', 'status' => 'Pengajuan ditolak' ,'color' => 'danger'],
            ['id' => 'S07', 'status' => 'Pengajuan ditolak' ,'color' => 'success'],
            ['id' => 'S08', 'status' => 'Menunggu Jadwal Presentasi','color' => 'dark'],
            ['id' => 'S09', 'status' => 'Presentasi','color' => 'dark'],
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

