<?php

namespace App\Services;

use App\Models\Player;
use App\Models\Progress;
use App\Models\Reward;

/**
 * Servicio Central del Juego: Gestiona la lógica de progresión, recompensas y niveles.
 */
class GameService
{
    /**
     * Mundos disponibles y su configuración pedagógica básica.
     */
    public const WORLDS = [
        'sol' => [
            'name' => 'Clave de Sol',
            'color' => 'purple',
            'levels' => 50
        ],
        'fa' => [
            'name' => 'Clave de Fa',
            'color' => 'blue',
            'levels' => 50
        ]
    ];

    /**
     * Obtiene el mapa completo de niveles para un jugador y mundo.
     * Calcula qué niveles están desbloqueados basándose en una progresión secuencial estricta.
     */
    public function getPlayerProgress(Player $player, string $worldCode): array
    {
        if (!isset(self::WORLDS[$worldCode])) {
            return [];
        }

        $levelsCount = self::WORLDS[$worldCode]['levels'];
        
        // Obtenemos todos los registros de progreso para este mundo (excluyendo retos especiales 99)
        $progressRecords = $player->progress()
            ->where('world', $worldCode)
            ->where('level', '<', 90)
            ->get()
            ->keyBy('level');
        
        $map = [];
        $unlockedUntil = 1;

        // Lógica de desbloqueo: solo desbloquea el siguiente nivel si el actual está completado
        for ($i = 1; $i <= $levelsCount; $i++) {
            $record = $progressRecords->get($i);
            if ($record && $record->is_completed) {
                $unlockedUntil = $i + 1;
            } else {
                // Si el nivel i no está completo, el primero bloqueado es i o i+1
                break;
            }
        }

        for ($i = 1; $i <= $levelsCount; $i++) {
            $record = $progressRecords->get($i);
            $map[] = [
                'level' => $i,
                'is_unlocked' => $i <= $unlockedUntil,
                'is_completed' => $record ? $record->is_completed : false,
                'stars' => $record ? $record->stars : 0,
            ];
        }

        return $map;
    }

    /**
     * Registra la finalización de un nivel, persistiendo estrellas y mejores puntuaciones.
     */
    public function completeLevel(Player $player, string $world, int $level, int $stars, int $score = 0): Progress
    {
        // Actualizamos o creamos el registro de progreso
        $existing = Progress::where(['player_id' => $player->id, 'world' => $world, 'level' => $level])->first();
        
        return Progress::updateOrCreate(
            ['player_id' => $player->id, 'world' => $world, 'level' => $level],
            [
                'stars' => max($stars, $existing?->stars ?? 0),
                'is_completed' => true,
                'best_score' => max($score, $existing?->best_score ?? 0),
            ]
        );
    }

    /**
     * Motor de Recompensas: Verifica si el jugador merece una medalla o un objeto sorpresa.
     * Retorna el código de la recompensa ganada o null.
     */
    public function checkRewards(Player $player, string $world, int $level): ?string
    {
        $newRewardCode = null;

        // 1. Hitos de Medallas Milestones
        if ($level == 10) $newRewardCode = 'level_10';
        if ($level == 20) $newRewardCode = 'level_20';
        if ($level == 30) $newRewardCode = 'level_30';
        if ($level == 40) $newRewardCode = 'level_40';

        // 2. Trofeo de Mundo Completado
        if ($level == self::WORLDS[$world]['levels']) {
            $newRewardCode = "world_{$world}_complete";
        }

        if ($newRewardCode) {
            $reward = Reward::where('code', $newRewardCode)->first();
            
            // Otorgar solo si no existe ya en su colección
            if ($reward && !$player->rewards()->where('reward_id', $reward->id)->exists()) {
                $player->rewards()->attach($reward->id, ['earned_at' => now()]);
                return $newRewardCode;
            }
        }

        // 3. Sistema de "Loot" Aleatorio (Personajes e Instrumentos)
        // 10% de probabilidad de encontrar algo raro tras cualquier nivel
        if (rand(1, 100) <= 10) {
            $randomType = rand(0, 1) ? 'character' : 'instrument';
            $randomReward = Reward::where('type', $randomType)
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
     * Sugiere el último nivel relevante jugado por el usuario para la función "Continuar".
     */
    public function getLastPlayedLevel(Player $player): ?Progress
    {
        return $player->progress()
            ->where('level', '<', 90) // Excluimos minijuegos de velocidad
            ->orderBy('updated_at', 'desc')
            ->first();
    }

    /**
     * Generador de ejercicios: Crea secuencias de notas basadas en la dificultad y mundo.
     * Implementa la progresión pedagógica real.
     */
    public function generateLevelNotes(string $world, int $level): array
    {
        // Banco de notas Clave de Sol (Registro central y agudo)
        $notesSol = ['C4', 'D4', 'E4', 'F4', 'G4', 'A4', 'B4', 'C5', 'D5', 'E5', 'F5', 'G5'];
        
        // Banco de notas Clave de Fa (Registro grave y medio)
        $notesFaAll = ['G2', 'A2', 'B2', 'C3', 'D3', 'E3', 'F3', 'G3', 'A3', 'B3', 'C4'];

        if ($world === 'sol') {
            // Aumentamos el rango de notas disponibles gradualmente
            $availableNotes = array_slice($notesSol, 0, min(count($notesSol), 2 + $level));
        } else {
            // Lógica pedagógica para Clave de Fa (Dividida por registros)
            if ($level <= 10) {
                // Fase 1: Registro Superior (Notas más fáciles de relacionar con Sol)
                $availableNotes = ['D3', 'E3', 'F3', 'G3', 'A3', 'B3', 'C4'];
            } elseif ($level <= 20) {
                // Fase 2: Registro Inferior (Familiarización con las profundidades)
                $availableNotes = ['G2', 'A2', 'B2', 'C3', 'D3'];
            } else {
                // Fase 3: Registro Completo
                $availableNotes = $notesFaAll;
            }
        }

        // Longitud de la secuencia: escala de 3 a 8 notas según el nivel
        $sequenceLength = min(8, 3 + floor($level / 3));

        $sequence = [];
        for ($i = 0; $i < $sequenceLength; $i++) {
            $note = $availableNotes[array_rand($availableNotes)];
            $sequence[] = [
                'pitch' => $note,
                'highlighted' => false,
                'status' => 'pending',
                'hidden' => $level > 30 // Niveles 31-40: el reto es ubicar la nota sin verla
            ];
        }

        return $sequence;
    }
}
