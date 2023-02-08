<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();

        User::factory()->create(
            [
                'email' => 'public1@test.com',
                'password' => bcrypt('Public@1')
            ]
        );

        User::factory()->create(
            [
                'email' => 'public2@test.com',
                'password' => bcrypt('Public@2')
            ]
        );
    }
}
