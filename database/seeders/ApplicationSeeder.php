<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\ServiceRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Application::factory()->create([
            'applicant_id' => 6,
            'scientist_id' => 13,
            'sample_submission' => 'In-person'
        ]);

        Application::factory()->create([
            'applicant_id' => 6,
            'scientist_id' => 13,
            'sample_submission' => 'Delivery'

        ]);
        Application::factory()->create([
            'applicant_id' => 7,
            'scientist_id' => 14,
            'sample_submission' => 'In-person'
        ]);

        Application::factory()->create([
            'applicant_id' => 7,
            'scientist_id' => 14,
            'sample_submission' => 'Delivery'
        ]);

        Application::factory()->create([
            'applicant_id' => 13,
            'sample_submission' => 'In-person'
        ]);

        Application::factory()->create([
            'applicant_id' => 13,
            'sample_submission' => 'Delivery'

        ]);
        Application::factory()->create([
            'applicant_id' => 14,
            'sample_submission' => 'In-person'
        ]);

        Application::factory()->create([
            'applicant_id' => 14,
            'sample_submission' => 'Delivery'
        ]);

        Application::factory(25)->create()->each(function () {
            ServiceRequest::factory(3)->create();
        });
    }
}
