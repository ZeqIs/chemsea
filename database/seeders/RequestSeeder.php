<?php

namespace Database\Seeders;

use App\Models\ServiceRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ServiceRequest::factory(2)->create([
            'application_id' => 1
        ]);

        ServiceRequest::factory(2)->create([
            'application_id' => 2
        ]);

        ServiceRequest::factory(2)->create([
            'application_id' => 3
        ]);

        ServiceRequest::factory(2)->create([
            'application_id' => 4
        ]);

        ServiceRequest::factory(2)->create([
            'application_id' => 5
        ]);

        ServiceRequest::factory(2)->create([
            'application_id' => 6
        ]);

        ServiceRequest::factory(2)->create([
            'application_id' => 7
        ]);

        ServiceRequest::factory(2)->create([
            'application_id' => 8
        ]);
    }
}
