<?php

namespace Database\Seeders;

use App\Models\TktTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TktTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['title' => 'TKT 1', 'research_type_id' => '1'],
            ['title' => 'TKT 2', 'research_type_id' => '1'],
            ['title' => 'TKT 3', 'research_type_id' => '1'],
            ['title' => 'TKT 4',  'research_type_id' => '2'],
            ['title' => 'TKT 5', 'research_type_id' => '2'],
            ['title' => 'TKT 6', 'research_type_id' => '2'],
            ['title' => 'TKT 7', 'research_type_id' => '2'],
            ['title' => 'TKT 8', 'research_type_id' => '2'],
            ['title' => 'TKT 9', 'research_type_id' => '2'],
            ['title' => 'TKT 10', 'research_type_id' => '2'],
        ];
        foreach ($data as $item) {
            TktTypes::create([
                'title' => $item['title'],
                'research_type_id' => $item['research_type_id'],
            ]);
        }
    }
}
