<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario administrador
        User::create([
            'username' => 'admin',
            'password' => 'password',
            'nombre_completo' => 'Administrador',
            'rol' => 'admin',
            'activo' => true,
        ]);

        // Crear usuario profesor
        User::create([
            'username' => 'profesor1',
            'password' => 'password',
            'nombre_completo' => 'María García',
            'rol' => 'profesor',
            'activo' => true,
        ]);

        // Crear usuario estudiante
        User::create([
            'username' => 'estudiante1',
            'password' => 'password',
            'nombre_completo' => 'Juan Pérez',
            'rol' => 'estudiante',
            'activo' => true,
        ]);
    }
}
