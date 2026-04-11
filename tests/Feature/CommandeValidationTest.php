<?php

use App\Models\Client;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin peut acceder a la liste des commandes', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $this->actingAs($admin);

    $response = $this->get(route('admin.commandes.index'));

    $response->assertStatus(200);
});

test('utilisateur non admin ne peut pas acceder a la liste des commandes', function () {
    $user = User::factory()->create(['role' => 'user']);
    $this->actingAs($user);

    $response = $this->get(route('admin.commandes.index'));

    $response->assertStatus(403);
});

test('admin peut accepter une commande en attente', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $client = Client::factory()->create();
    $produit = Produit::create([
        'nom' => 'Plastique',
        'type' => 'matiere_premiere',
        'unite_mesure' => 'kg',
        'prix_unitaire' => 10,
        'description' => 'Test',
        'statut' => 'actif',
        'trie_id' => null,
    ]);
    $stock = Stock::create([
        'code_stock' => 'STOCK001',
        'nom' => 'Plastique',
        'quantite_disponible' => 100,
        'prix_unitaire' => 10,
        'unite_mesure' => 'kg',
        'seuil_alerte' => 10,
        'produit_id' => $produit->id,
    ]);

    $commande = Commande::create([
        'code_commande' => 'CMD001',
        'produit' => 'Plastique',
        'produit_id' => $produit->id,
        'quantite' => 10,
        'statut' => 'en_attente',
        'client_id' => $client->id,
        'date_commande' => now(),
    ]);

    $this->actingAs($admin);

    $response = $this->post(route('commandes.accepter', $commande->id));

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $commande->refresh();
    expect($commande->statut)->toBe('acceptee');

    $stock->refresh();
    expect($stock->quantite_disponible)->toBe(90);
});

test('admin peut refuser une commande en attente', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $client = Client::factory()->create();

    $commande = Commande::factory()->create([
        'client_id' => $client->id,
        'statut' => 'en_attente',
    ]);

    $this->actingAs($admin);

    $response = $this->post(route('commandes.refuser', $commande->id));

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $commande->refresh();
    expect($commande->statut)->toBe('refusee');
});

test('accepter commande avec stock insuffisant echoue', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $client = Client::factory()->create();
    $produit = Produit::create([
        'nom' => 'Plastique',
        'type' => 'matiere_premiere',
        'unite_mesure' => 'kg',
        'prix_unitaire' => 10,
        'description' => 'Test',
        'statut' => 'actif',
        'trie_id' => null,
    ]);
    $stock = Stock::create([
        'code_stock' => 'STOCK001',
        'nom' => 'Plastique',
        'quantite_disponible' => 5,
        'prix_unitaire' => 10,
        'unite_mesure' => 'kg',
        'seuil_alerte' => 10,
        'produit_id' => $produit->id,
    ]);

    $commande = Commande::create([
        'code_commande' => 'CMD001',
        'produit' => 'Plastique',
        'produit_id' => $produit->id,
        'quantite' => 10,
        'statut' => 'en_attente',
        'client_id' => $client->id,
        'date_commande' => now(),
    ]);

    $this->actingAs($admin);

    $response = $this->post(route('commandes.accepter', $commande->id));

    $response->assertRedirect();
    $response->assertSessionHasErrors('error');

    $commande->refresh();
    expect($commande->statut)->toBe('en_attente');
});

test('accepter commande deja traitee echoue', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $client = Client::factory()->create();
    $produit = Produit::create([
        'nom' => 'Plastique',
        'type' => 'matiere_premiere',
        'unite_mesure' => 'kg',
        'prix_unitaire' => 10,
        'description' => 'Test',
        'statut' => 'actif',
        'trie_id' => null,
    ]);

    $commande = Commande::create([
        'code_commande' => 'CMD001',
        'produit' => 'Plastique',
        'produit_id' => $produit->id,
        'quantite' => 10,
        'statut' => 'acceptee',
        'client_id' => $client->id,
        'date_commande' => now(),
    ]);

    $this->actingAs($admin);

    $response = $this->post(route('commandes.accepter', $commande->id));

    $response->assertRedirect();
    $response->assertSessionHasErrors('error');

    $commande->refresh();
    expect($commande->statut)->toBe('acceptee');
});
