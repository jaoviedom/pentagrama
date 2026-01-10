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
        $progress = $player->progress()->where('world', $worldCode)->get()->keyBy('level');
        
        $map = [];
        $unlockedUntil = 1;

        // Encontrar el último nivel completado para determinar qué está desbloqueado
        foreach ($progress as $p) {
            if ($p->is_completed) {
                $unlockedUntil = max($unlockedUntil, $p->level + 1);
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
     * Obtener el último nivel jugado para sugerir continuar
     */
    public function getLastPlayedLevel(Player $player)
    {
        return $player->progress()->orderBy('updated_at', 'desc')->first();
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
