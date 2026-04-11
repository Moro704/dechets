<?php

namespace Database\Factories;

use App\Models\Pesage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pesage>
 */
class PesageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'poids_total' => $this->faker->randomFloat(2, 1, 1000),
            'date_pesage' => $this->faker->date(),
        ];
    }
}
