<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $applicant = User::all();
        $scientist = User::where('scientist', 1)->get();
        $applicant_id = fake()->randomElement($applicant)->id;
        $scientist_id = fake()->randomElement($scientist)->id;
        return [
            'applicant_id' => $applicant_id,
            'scientist_id' => $scientist_id,
            'sample_type' => fake()->word(),
            'sample_name' => fake()->sentence(rand(1, 3)),
            'sample_submission' => 'In-person'
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Application $application) {
            $application->name = date("Ymd")  . "_" . $application->applicant_id  . "_" . implode(explode(" ", $application->sample_name)) . "_" . $application->id;
            $application->save();
        });
    }
}
