<?php

namespace App\Services;

use App\Models\Player;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PlayerService
{
    /**
     * Crear un nuevo jugador infantil
     */
    public function createPlayer(User $user, array $data): Player
    {
        return $user->players()->create([
            'nickname' => $data['nickname'],
            'avatar' => $data['avatar'],
            'color' => $data['color'],
            'pin' => $data['pin'],
        ]);
    }

    /**
     * Registrar acceso del jugador
     */
    public function recordAccess(Player $player): void
    {
        $player->update([
            'last_access_at' => now(),
        ]);
    }

    /**
     * Verificar PIN del jugador
     */
    public function verifyPin(Player $player, string $pin): bool
    {
        return $player->pin === $pin;
    }
}
