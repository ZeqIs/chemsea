<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\ServiceReport;
use App\Models\ServiceRequest;
use App\Models\ServiceType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceRequest>
 */
class ServiceRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $application = Application::all();
        $serviceType = ServiceType::all();
        return [
            'application_id' => fake()->randomElement($application)->id,
            'service_type_id' => fake()->randomElement($serviceType)->id,
            'detail' => fake()->paragraph(2)
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (ServiceRequest $request) {
            $request->name = $request->application->name . "_" . $request->serviceType->abbr;
            $request->save();
        });
    }
}
