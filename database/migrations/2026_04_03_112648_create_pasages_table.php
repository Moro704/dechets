<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pesage', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_collecte')           // Clé étrangère vers collectes
                ->constrained('collectes')           // référence la table collectes
                ->onDelete('cascade');               // si on supprime une collecte, on supprime le pesage

            $table->decimal('poids', 10, 2);           // Poids en kg (ex: 1250.75)
            $table->string('unite')->default('kg');    // kg, tonne, etc.

            $table->text('description')->nullable();
            $table->string('statut')->default('Validé');

            $table->timestamps();   // created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesage');
    }
};
