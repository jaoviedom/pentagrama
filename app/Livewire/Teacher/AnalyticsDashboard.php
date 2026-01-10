<?php

namespace App\Livewire\Teacher;

use Livewire\Component;

class AnalyticsDashboard extends Component
{
    public $playersData = [];
    public $noteNames = ['C' => 'Do', 'D' => 'Re', 'E' => 'Mi', 'F' => 'Fa', 'G' => 'Sol', 'A' => 'La', 'B' => 'Si'];

    public function mount()
    {
        $this->loadAnalytics();
    }

    public function loadAnalytics()
    {
        $user = auth()->user();
        $players = \App\Models\Player::where('user_id', $user->id)->get();

        foreach ($players as $player) {
            // 1. Progreso por mundo
            $progressSol = \App\Models\Progress::where('player_id', $player->id)
                ->where('world', 'sol')
                ->where('level', '<', 90)
                ->where('is_completed', true)
                ->max('level') ?? 0;

            $progressFa = \App\Models\Progress::where('player_id', $player->id)
                ->where('world', 'fa')
                ->where('level', '<', 90)
                ->where('is_completed', true)
                ->max('level') ?? 0;

            // 2. Notas con más errores (Agregamos lógica de conteo manual por compatibilidad con SQLite JSON)
            $errorLogs = \App\Models\GameLog::where('player_id', $player->id)
                ->where('event_type', 'error')
                ->get();

            $failedNotes = [];
            foreach ($errorLogs as $log) {
                $pitch = $log->data['pitch'] ?? 'Unknown';
                if (!isset($failedNotes[$pitch])) $failedNotes[$pitch] = 0;
                $failedNotes[$pitch]++;
            }
            arsort($failedNotes);
            $topFailed = array_slice($failedNotes, 0, 5, true);

            // 3. Tiempo de uso (Segundos a Minutos)
            $totalSeconds = \App\Models\GameLog::where('player_id', $player->id)
                ->where('event_type', 'level_complete')
                ->sum(\Illuminate\Support\Facades\DB::raw("CAST(JSON_EXTRACT(data, '$.duration') AS INTEGER)")); 
            
            // Si SQLite no soporta JSON_EXTRACT directamente en sum, lo hacemos en PHP para mayor seguridad
            if ($totalSeconds == 0) {
                $completeLogs = \App\Models\GameLog::where('player_id', $player->id)
                    ->where('event_type', 'level_complete')
                    ->get();
                foreach($completeLogs as $l) $totalSeconds += ($l->data['duration'] ?? 0);
            }

            $this->playersData[] = [
                'player' => $player,
                'progress' => [
                    'sol' => $progressSol,
                    'fa' => $progressFa
                ],
                'top_failed' => $topFailed,
                'usage_time' => round($totalSeconds / 60, 1) // en minutos
            ];
        }
    }

    public function render()
    {
        return view('livewire.teacher.analytics-dashboard');
    }
}
