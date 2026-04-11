<?php

namespace Database\Factories;

use App\Models\Produit;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code_stock' => $this->faker->unique()->word(),
            'nom' => $this->faker->word(),
            'quantite_disponible' => $this->faker->numberBetween(0, 1000),
            'prix_unitaire' => $this->faker->randomFloat(2, 1, 100),
            'unite_mesure' => $this->faker->randomElement(['kg', 'litres', 'tonnes']),
            'seuil_alerte' => $this->faker->numberBetween(10, 100),
            'produit_id' => Produit::factory(),
        ];
    }
}
