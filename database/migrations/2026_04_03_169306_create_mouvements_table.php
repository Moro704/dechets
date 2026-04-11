<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mouvements', function (Blueprint $table) {
            $table->id();

            $table->enum('type_mouvement', ['entrée', 'sortie'])->index();   // Plus sécurisé

            $table->decimal('quantite', 15, 2);

            $table->string('source');                       // ex: Commande Client, Production, Ajustement, Perte
            $table->text('description')->nullable();

            // Clés étrangères
            $table->foreignId('commande_id')
                ->nullable()
                ->constrained('commandes')
                ->onDelete('set null');

            $table->foreignId('stock_id')
                ->constrained('stocks')
                ->onDelete('cascade');

            // Date du mouvement (très important pour les rapports)
            $table->date('date_mouvement')->nullable()->index();
            $table->time('heure_mouvement')->nullable();   // Optionnel mais utile

            $table->timestamps();

            // Index pour de meilleures performances sur les filtres
            $table->index(['date_mouvement', 'type_mouvement']);
            $table->index(['stock_id', 'date_mouvement']);
            $table->index('commande_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mouvements');
    }
};
