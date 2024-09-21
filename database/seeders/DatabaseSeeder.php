<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call([UserRolePermissionSeeder::class]);
        $this->call([PermissionSeeder::class]);
        $this->call([StudyProgramSeeder::class]);
        $this->call([DepartementSeeder::class]);
        $this->call([ResearchTypesSeeder::class]);
        $this->call([TktTypesSeeder::class]);
        $this->call([MainResearchTargetSeeder::class]);
        $this->call([StatusSeeder::class]);

        $this->call([ResearchCategoriesSeeder::class]);
        $this->call([BankSeeder::class]);
        $this->call([ResearchThemesSeeder::class]);
        $this->call([ResearchTopicsSeeder::class]);
        $this->call([DocumentsSeeder::class]);
        // $this->call([ReviewerSeeder::class]);
        // $this->call([Warek1Seeder::class]);
        // $this->call([Warek2Seeder::class]);


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
