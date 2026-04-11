<?php

namespace Database\Factories;

use App\Models\Trie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Produit>
 */
class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->word(),
            'type' => $this->faker->randomElement(['matiere_premiere', 'produit_fini']),
            'unite_mesure' => $this->faker->randomElement(['kg', 'litres', 'tonnes']),
            'prix_unitaire' => $this->faker->randomFloat(2, 1, 100),
            'description' => $this->faker->sentence(),
            'statut' => 'actif',
            'trie_id' => Trie::factory(),
        ];
    }
}
