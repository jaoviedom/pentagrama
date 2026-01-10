<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Crear un nuevo usuario
     */
    public function createUser(array $data): User
    {
        return User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'nombre_completo' => $data['nombre_completo'],
            'avatar' => $data['avatar'] ?? null,
            'rol' => $data['rol'] ?? 'estudiante',
            'activo' => $data['activo'] ?? true,
        ]);
    }

    /**
     * Actualizar un usuario existente
     */
    public function updateUser(User $user, array $data): User
    {
        $updateData = [
            'nombre_completo' => $data['nombre_completo'] ?? $user->nombre_completo,
            'avatar' => $data['avatar'] ?? $user->avatar,
            'rol' => $data['rol'] ?? $user->rol,
            'activo' => $data['activo'] ?? $user->activo,
        ];

        if (isset($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);

        return $user->fresh();
    }

    /**
     * Obtener usuarios por rol
     */
    public function getUsersByRole(string $role)
    {
        return User::where('rol', $role)
            ->where('activo', true)
            ->get();
    }

    /**
     * Activar/Desactivar usuario
     */
    public function toggleUserStatus(User $user): User
    {
        $user->update(['activo' => !$user->activo]);
        return $user->fresh();
    }
}
