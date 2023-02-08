<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScientistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create(['scientist' => 1]);

        User::factory()->create(
            [
                'email' => 'scientist@test.com',
                'password' => bcrypt('Scientist@1'),
                'scientist' => 1
            ]
        );

        User::factory()->create(
            [
                'email' => 'scientist2@test.com',
                'password' => bcrypt('Scientist@2'),
                'scientist' => 1
            ]
        );
    }
}
