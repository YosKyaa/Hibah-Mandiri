<?php

namespace Database\Seeders;

use App\Models\ResearchTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResearchTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $research_types = [
            'Penelitian Dasar',
            'Penelitian Terapan',
        ];
        foreach ($research_types as $title) {
            ResearchTypes::create([
                'title' => $title,
            ]);
        }
    }
}
