<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();

            // Champ métier selon ton diagramme
            $table->string('code_stock')->unique();           // IdStock : String

            $table->string('nom');
            $table->decimal('quantite_disponible', 15, 2);
            $table->decimal('prix_unitaire', 15, 2);
            $table->string('unite_mesure')->default('kg');

            $table->decimal('seuil_alerte', 12, 2)->default(100); // ex: alerte si < 100 kg

            // Clés étrangères demandées
            $table->foreignId('produit_id')
                ->constrained('produits')
                ->onDelete('cascade');

            $table->foreignId('commande_id')
                ->nullable()                    // une commande peut ne pas encore être liée
                ->constrained('commandes')
                ->onDelete('set null');         // si commande supprimée, on garde le stock

            $table->timestamps();

            // Index pour performances
            $table->index(['produit_id', 'commande_id']);
            $table->index('quantite_disponible');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
