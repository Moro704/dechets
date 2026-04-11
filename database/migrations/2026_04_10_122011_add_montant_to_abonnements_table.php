<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('abonnements', function (Blueprint $table) {
            $table->decimal('montant', 10, 2)->nullable()->after('type_abonnement');
            // nullable = on peut le laisser vide pour l'instant
            // Tu peux mettre ->default(0) si tu veux une valeur par défaut
        });
    }

    public function down()
    {
        Schema::table('abonnements', function (Blueprint $table) {
            $table->dropColumn('montant');
        });
    }
};