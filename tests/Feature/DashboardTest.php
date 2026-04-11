<?php

use App\Models\User;

test('dashboard page is accessible for authenticated verified user', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $response = $this
        ->actingAs($user)
        ->get('/dashboard');

    $response
        ->assertOk()
        ->assertSee('Tableau de bord')
        ->assertSee('Clients actifs');
});
