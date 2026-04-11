<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('planifications', function (Blueprint $table) {
            $table->id();                    // idPlanification

            $table->string('code_planification')->unique();
            $table->string('nom_tournee')->nullable();

            $table->string('jour_semaine', 20);           // "Mardi", "Mercredi", ...
            $table->date('date_prevue')->nullable();      // Pour les dates spécifiques
            $table->string('periode')->default('HEBDOMADAIRE'); // HEBDOMADAIRE, BI_HEBDOMADAIRE

            $table->string('type_collecte');              // "SYSTEMATIQUE" ou "MIXTE"
            $table->string('statut')->default('ACTIVE');  // ACTIVE, SUSPENDUE, TERMINEE, ANNULEE

            // Clés étrangères
            $table->foreignId('zone_id')
                ->constrained('zones')
                ->onDelete('cascade');

            $table->foreignId('collecteur_id')
                ->constrained('collecteurs')
                ->onDelete('cascade');

            // Optionnel : si vous voulez lier à une déclaration de déchet spécifique
            $table->foreignId('declaration_id')
                ->nullable()
                ->constrained('declarations')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('planifications');
    }
};
