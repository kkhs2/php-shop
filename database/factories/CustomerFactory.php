<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          //
          'title' => $this->faker->title(),
          'firstName' => $this->faker->firstName(),
          'lastName' => $this->faker->lastName(),
          'houseNumberName' => $this->faker->buildingNumber(),
          'street' => $this->faker->streetName(),
          'townCity' => $this->faker->city(),
          'postCode' => $this->faker->postcode(),
          'stateCounty' => $this->faker->county(),
          'country' => 'United Kingdom',
          'email' => $this->faker->unique()->safeEmail(),
          'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'

        ];
    }
}
