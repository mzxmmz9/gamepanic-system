<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('hunihuni'),
        ]);

        //php
        $this->call([
            BranchesTableSeeder::class,
            CompaniesTableSeeder::class,
            CategoriesTableSeeder::class,
            StatusTableSeeder::class,
            PlansTableSeeder::class
        ]);

        //csv
        $this->call([
            BoardsTableSeeder::class,
            MachinesTableSeeder::class,
            Machine_BoardTableSeeder::class,
            Machine_downtimeTableSeeder::class,
            Machine_statusTableSeeder::class,
            Machine_categoryTableSeeder::class,
            Machine_locationTableSeeder::class,
            Machine_ownershipTableSeeder::class,
            Machine_planTableSeeder::class,
            Machine_branchTableSeeder::class
        ]);

    }
}

