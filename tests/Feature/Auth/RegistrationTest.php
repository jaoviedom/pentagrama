<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('la página de registro es accesible', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
    $response->assertSee('Crea tu cuenta');
});

test('un guardián puede registrarse correctamente', function () {
    $response = $this->post('/register', [
        'nombre_completo' => 'Nuevo Guardián',
        'username' => 'guardian_test',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertAuthenticated();

    $user = User::where('username', 'guardian_test')->first();
    expect($user)->not->toBeNull();
    expect($user->nombre_completo)->toBe('Nuevo Guardián');
    expect($user->rol)->toBe('profesor');
});

test('el registro falla si faltan campos requeridos', function () {
    $response = $this->post('/register', [
        'nombre_completo' => '',
        'username' => '',
        'password' => '',
    ]);

    $response->assertSessionHasErrors(['nombre_completo', 'username', 'password']);
});

test('el nombre de usuario debe ser único', function () {
    User::factory()->create([
        'username' => 'existente',
    ]);

    $response = $this->post('/register', [
        'nombre_completo' => 'Otro Guardián',
        'username' => 'existente',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertSessionHasErrors(['username']);
});

test('la contraseña debe ser confirmada', function () {
    $response = $this->post('/register', [
        'nombre_completo' => 'Otro Guardián',
        'username' => 'guardian_conf',
        'password' => 'password123',
        'password_confirmation' => 'diferente',
    ]);

    $response->assertSessionHasErrors(['password']);
});
