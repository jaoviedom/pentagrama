<?php

namespace App\Livewire\Teacher;

use Livewire\Component;

class AnalyticsDashboard extends Component
{
    public $playersData = [];
    public $noteNames = ['C' => 'Do', 'D' => 'Re', 'E' => 'Mi', 'F' => 'Fa', 'G' => 'Sol', 'A' => 'La', 'B' => 'Si'];

    // Variables para el modal de confirmación de reinicio
    public $confirmingReset = false;
    public $playerToResetId = null;
    public $playerToResetNickname = '';
    public $worldToReset = '';

    public function mount()
    {
        $this->loadAnalytics();
    }

    public function loadAnalytics()
    {
        $user = auth()->user();
        $players = \App\Models\Player::where('user_id', $user->id)->get();
        $this->playersData = []; // Limpiar datos previos para actualización reactiva

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

            // 2. Resultados de Minijuegos (Solo Velocidad ya que Reto se eliminó)
            // Desafío de Velocidad (Level 99)
            $speedRecord = \App\Models\Progress::where('player_id', $player->id)
                ->where('level', 99)
                ->max('best_score') ?? 0;

            // 3. Notas con más errores
            $errorLogs = \App\Models\GameLog::where('player_id', $player->id)
                ->where('event_type', 'error')
                ->get();

            $failedNotes = [];
            foreach ($errorLogs as $log) {
                $pitch = $log->data['pitch'] ?? 'Unknown';
                if (!isset($failedNotes[$pitch]))
                    $failedNotes[$pitch] = 0;
                $failedNotes[$pitch]++;
            }
            arsort($failedNotes);
            $topFailed = array_slice($failedNotes, 0, 5, true);

            // 4. Tiempo de uso
            $totalSeconds = 0;
            $completeLogs = \App\Models\GameLog::where('player_id', $player->id)
                ->where('event_type', 'level_complete')
                ->get();
            foreach ($completeLogs as $l)
                $totalSeconds += ($l->data['duration'] ?? 0);

            $this->playersData[] = [
                'player' => $player,
                'progress' => [
                    'sol' => $progressSol,
                    'fa' => $progressFa
                ],
                'minigames' => [
                    'speed_record' => $speedRecord,
                ],
                'top_failed' => $topFailed,
                'usage_time' => round($totalSeconds / 60, 1)
            ];
        }
    }

    public function confirmReset($playerId, $nickname, $world)
    {
        $this->playerToResetId = $playerId;
        $this->playerToResetNickname = $nickname;
        $this->worldToReset = $world;
        $this->confirmingReset = true;
    }

    public function cancelReset()
    {
        $this->confirmingReset = false;
        $this->playerToResetId = null;
        $this->playerToResetNickname = '';
        $this->worldToReset = '';
    }

    public function resetProgress()
    {
        if (!$this->playerToResetId || !$this->worldToReset)
            return;

        $player = \App\Models\Player::findOrFail($this->playerToResetId);
        $playerId = $this->playerToResetId;
        $world = $this->worldToReset;

        // 1. Eliminar el progreso de niveles en ese mundo
        \App\Models\Progress::where('player_id', $playerId)
            ->where('world', $world)
            ->where('level', '<', 90)
            ->delete();

        // 2. Eliminar logs asociados a ese mundo para limpiar analíticas
        \App\Models\GameLog::where('player_id', $playerId)
            ->where('world', $world)
            ->delete();

        // 3. Quitar las recompensas obtenidas en ese mundo (medallas y premios específicos)
        $rewardCodes = ($world === 'sol')
            ? ['sol_level_10', 'sol_level_20', 'sol_level_30', 'sol_level_40', 'sol_level_60', 'sol_level_70', 'sol_level_80', 'world_sol_complete', 'inst_piano', 'char_fox', 'inst_guitar', 'inst_violin']
            : ['fa_level_10', 'fa_level_20', 'fa_level_30', 'fa_level_40', 'fa_level_60', 'fa_level_70', 'fa_level_80', 'world_fa_complete', 'inst_drum', 'char_bear', 'inst_trumpet', 'char_lion'];

        $rewards = \App\Models\Reward::whereIn('code', $rewardCodes)->pluck('id');
        $player->rewards()->detach($rewards);

        $this->loadAnalytics();
        $this->cancelReset();
        session()->flash('success', "¡Progreso de " . ($world === 'sol' ? 'Clave de Sol' : 'Clave de Fa') . " reiniciado con éxito!");
    }

    public function render()
    {
        return view('livewire.teacher.analytics-dashboard');
    }
}
