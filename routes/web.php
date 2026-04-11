<?php

use App\Http\Controllers\AbonnementsController;
use App\Http\Controllers\AgentsController;
use App\Http\Controllers\AlertesController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CollecteurController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventaireController;
use App\Http\Controllers\MouvementController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PlanificationController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\StockEntreeController;
use App\Http\Controllers\SuiviCollecteController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Gestion des Zones
    Route::resource('zones', ZoneController::class);
    // Gestion des Collecteurs
    Route::resource('collecteurs', CollecteurController::class);
    // Gestion des Agents
    Route::resource('agents', AgentsController::class);
    // Gestion des Clients
    Route::resource('clients', ClientController::class);
    // Gestion des Produits
    Route::resource('produits', ProduitController::class);
    // Gestion de l'Inventaire
    Route::resource('inventaire', InventaireController::class);
    // Gestion des Entrées de Stock
    Route::resource('stock-entree', StockEntreeController::class)->parameters([
        'stock-entree' => 'stockEntree',
    ]);
    // Gestion des Mouvements de Stock
    Route::resource('mouvements', MouvementController::class);
    // Gestion des Alertes de Stock
    Route::get('alertes', [AlertesController::class, 'index'])->name('alertes.index');
    Route::get('alertes/rapport', [AlertesController::class, 'rapport'])->name('alertes.rapport');
    Route::post('alertes/{alerte}/traiter', [AlertesController::class, 'marquerTraitee'])->name('alertes.traiter');
    // Gestion des Planifications
    Route::resource('planifications', PlanificationController::class);
    // Gestion des suivi de collecte
    Route::get('/suivi/collectes', [SuiviCollecteController::class, 'index'])
        ->name('suivi_collecte.index');
    // mouvement de sortie

    Route::get('/stock/entree', [StockEntreeController::class, 'create'])->name('stock.entree.create');
    Route::post('/stock/entree', [StockEntreeController::class, 'store'])->name('stock.entree.store');
    // Rapport
    Route::get('/rapports', [RapportController::class, 'index'])
        ->name('rapports.index');
    // commande
    Route::get('commandes', [CommandeController::class, 'index'])->name('commandes.index');
    Route::post('/commandes/{id}/accepter', [CommandeController::class, 'accepter'])->name('commandes.accepter');
    Route::post('/commandes/{id}/refuser', [CommandeController::class, 'refuser'])->name('commandes.refuser');

    // Paiements
    Route::resource('paiements', PaiementController::class);

    // Abonnements
    Route::resource('abonnements', AbonnementsController::class);

    // Configuration
    Route::view('/parametres', 'parametres.index')->name('parametres.index');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
});
// Profil Utilisateur
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__.'/auth.php';
