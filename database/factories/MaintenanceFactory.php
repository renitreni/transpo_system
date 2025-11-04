<?php

namespace Database\Factories;

use App\Enums\CarBrandsEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maintenance>
 */
class MaintenanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_cr' => fake()->randomNumber(7),
            'contact_person' => fake()->name(),
            'phone_no' => fake()->phoneNumber(),
            'email' => fake()->safeEmail(),
            'address' => fake()->address(),
            'note' => fake()->paragraph(),
            'brand_name' => fake()->randomElement(CarBrandsEnum::class)->value,
            'kilometers' => fake()->randomNumber(7),
            'hour' => fake()->randomNumber(7),
            'warranty' => fake()->word(),
            'others' => fake()->paragraph(),
            'vin_no' => fake()->randomNumber(7),
            'remarks' => fake()->paragraph(),
        ];
    }
}
