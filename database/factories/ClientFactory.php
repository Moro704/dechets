<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'typeclient' => $this->faker->randomElement(['particulier', 'entreprise']),
            'zone_id' => Zone::factory(),
        ];
    }
}
