<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tries', function (Blueprint $table) {
            $table->id();

            $table->string('type_dechet');                    // ex: Plastique, Métal, Papier, Organique...
            $table->decimal('quantite_trier', 12, 2);         // Quantité triée (en kg généralement)
            $table->string('unite')->default('kg');           // kg, litre, unité...

            // Relation avec Pesage
            $table->foreignId('pesage_id')
                ->constrained('pesage')   // nom correct de la table
                ->onDelete('cascade');

            $table->timestamps();

            // Index pour meilleures performances
            $table->index(['pesage_id', 'type_dechet']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tries');
    }
};
