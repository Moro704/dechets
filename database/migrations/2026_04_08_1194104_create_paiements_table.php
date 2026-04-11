<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();

            $table->string('mode_paiement');
            $table->decimal('montant', 10, 2);
            $table->string('type_paiement')->nullable();
            $table->string('reference_paiement')->nullable();
            $table->enum('statut', ['en_attente', 'valide', 'echoue'])->default('en_attente');
            $table->foreignId('commande_id')
                ->nullable()
                ->constrained('commandes')
                ->cascadeOnDelete();

            // === NOUVEAU : Clé étrangère vers abonnement (peut être nulle) ===
            $table->foreignId('abonnement_id')
                ->nullable()
                ->constrained('abonnements')
                ->cascadeOnDelete();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
