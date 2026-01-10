<?php

namespace App\Services;

use App\Models\Player;
use App\Models\Progress;

class GameService
{
    /**
     * Mundos disponibles
     */
    public const WORLDS = [
        'sol' => [
            'name' => 'Clave de Sol',
            'color' => 'purple',
            'levels' => 40
        ],
        'fa' => [
            'name' => 'Clave de Fa',
            'color' => 'blue',
            'levels' => 40
        ]
    ];

    /**
     * Obtener el progreso del jugador para un mundo específico
     */
    public function getPlayerProgress(Player $player, string $worldCode)
    {
        $levelsConfig = self::WORLDS[$worldCode]['levels'];
        // Excluimos niveles especiales (>= 90) de la progresión del mapa
        $progress = $player->progress()
            ->where('world', $worldCode)
            ->where('level', '<', 90)
            ->get()
            ->keyBy('level');
        
        $map = [];
        $unlockedUntil = 1;

        // Progresión secuencial estricta: desbloquea el siguiente solo si el actual está listo
        for ($i = 1; $i <= $levelsConfig; $i++) {
            $p = $progress->get($i);
            if ($p && $p->is_completed) {
                $unlockedUntil = $i + 1;
            } else {
                break;
            }
        }

        for ($i = 1; $i <= $levelsConfig; $i++) {
            $p = $progress->get($i);
            $map[] = [
                'level' => $i,
                'is_unlocked' => $i <= $unlockedUntil,
                'is_completed' => $p ? $p->is_completed : false,
                'stars' => $p ? $p->stars : 0,
            ];
        }

        return $map;
    }

    /**
     * Completar un nivel
     */
    public function completeLevel(Player $player, string $world, int $level, int $stars, int $score = 0)
    {
        return Progress::updateOrCreate(
            ['player_id' => $player->id, 'world' => $world, 'level' => $level],
            [
                'stars' => max($stars, Progress::where(['player_id' => $player->id, 'world' => $world, 'level' => $level])->value('stars') ?? 0),
                'is_completed' => true,
                'best_score' => max($score, Progress::where(['player_id' => $player->id, 'world' => $world, 'level' => $level])->value('best_score') ?? 0),
            ]
        );
    }

    /**
     * Verificar si el jugador ha ganado una nueva recompensa
     */
    public function checkRewards(Player $player, string $world, int $level): ?string
    {
        $newRewardCode = null;

        // 1. Hitos por niveles específicos
        if ($level == 10) $newRewardCode = 'level_10';
        if ($level == 20) $newRewardCode = 'level_20';
        if ($level == 30) $newRewardCode = 'level_30';

        // 2. Mundo completado (nivel 40)
        if ($level == self::WORLDS[$world]['levels']) {
            $newRewardCode = "world_{$world}_complete";
        }

        if ($newRewardCode) {
            $reward = \App\Models\Reward::where('code', $newRewardCode)->first();
            
            // Verificar si ya la tiene
            if ($reward && !$player->rewards()->where('reward_id', $reward->id)->exists()) {
                $player->rewards()->attach($reward->id, ['earned_at' => now()]);
                return $newRewardCode;
            }
        }

        // 3. Recompensas aleatorias (personajes/instrumentos) con baja probabilidad
        if (rand(1, 100) <= 10) { // 10% de probabilidad
            $randomType = rand(0, 1) ? 'character' : 'instrument';
            $randomReward = \App\Models\Reward::where('type', $randomType)
                ->whereDoesntHave('players', fn($q) => $q->where('player_id', $player->id))
                ->inRandomOrder()
                ->first();

            if ($randomReward) {
                $player->rewards()->attach($randomReward->id, ['earned_at' => now()]);
                return $randomReward->code;
            }
        }

        return null;
    }

    /**
     * Obtener el último nivel jugado para sugerir continuar
     */
    public function getLastPlayedLevel(Player $player)
    {
        return $player->progress()
            ->where('level', '<', 90) // Ignora retos y niveles especiales
            ->orderBy('updated_at', 'desc')
            ->first();
    }

    /**
     * Generar notas para un nivel específico
     */
    public function generateLevelNotes(string $world, int $level): array
    {
        $notesSol = ['C4', 'D4', 'E4', 'F4', 'G4', 'A4', 'B4', 'C5', 'D5', 'E5', 'F5', 'G5'];
        
        // Mapeo refinado para Fa según teoría pedagógica
        $notesFaAll = [
            'C2', 'D2', 'E2', 'F2', 'G2', 'A2', 'B2', 'C3', 'D3', 'E3', 'F3', 'G3', 'A3', 'B3', 'C4'
        ];

        if ($world === 'sol') {
            $availableNotes = array_slice($notesSol, 0, min(count($notesSol), 2 + $level));
        } else {
            // Progresión específica Clave de Fa
            if ($level <= 10) {
                // Registro Superior (Líneas 3 a 6/Añadida): D3 a C4
                $availableNotes = ['D3', 'E3', 'F3', 'G3', 'A3', 'B3', 'C4'];
            } elseif ($level <= 20) {
                // Registro Inferior (Líneas 1 a 3): G2 a D3
                $availableNotes = ['G2', 'A2', 'B2', 'C3', 'D3'];
            } else {
                // Registro Completo (Todas las líneas)
                $availableNotes = ['G2', 'A2', 'B2', 'C3', 'D3', 'E3', 'F3', 'G3', 'A3', 'B3', 'C4'];
            }
        }

        // Determinar cuántas notas tendrá la secuencia (escala con el nivel)
        $sequenceLength = min(8, 3 + floor($level / 3));

        $sequence = [];
        for ($i = 0; $i < $sequenceLength; $i++) {
            $note = $availableNotes[array_rand($availableNotes)];
            $sequence[] = [
                'pitch' => $note,
                'highlighted' => false,
                'status' => 'pending',
                'hidden' => $level > 30 // Se oculta la cabeza para niveles 31-40
            ];
        }

        return $sequence;
    }
}
