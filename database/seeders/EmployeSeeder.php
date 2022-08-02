<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmployeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employes')->insert([
            'lastname' => Str::random(15),
            'firstname' => Str::random(15),
            'cin' => Str::random(8),
        ]);
    }

}
