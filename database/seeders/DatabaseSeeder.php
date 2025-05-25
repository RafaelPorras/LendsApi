<?php

namespace Database\Seeders;

use App\Models\Lend;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lend::factory()
            ->count(20) // Create 20 lend records
            ->create();
    }
}
