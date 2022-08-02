<?php

namespace Database\Seeders;
use App\Models\Film;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Employe::factory(3)->create();
        \App\Models\User::factory(1)->create();
        \App\Models\Category::factory()
        ->has(Film::factory()->count(4))
        ->count(10)
        ->create();

    }
}
