<?php

namespace App\Livewire\Game;

use App\Models\Player;
use App\Models\Reward;
use App\Services\GameService;
use Livewire\Component;

class PlayerProfile extends Component
{
    public $player;
    public $stats = [];
    public $medals = [];
    public $recentRewards = [];

    public function mount()
    {
        $playerId = session('active_player_id');
        if (!$playerId) return redirect()->route('players.index');

        $this->player = Player::with(['progress', 'rewards'])->findOrFail($playerId);
        $this->calculateStats();
    }

    protected function calculateStats()
    {
        $progress = $this->player->progress;
        
        // Mundos completados (donde existe nivel 40 completado)
        $completedWorlds = $progress->where('level', 40)->where('is_completed', true)->pluck('world')->unique()->count();
        
        // Total de estrellas
        $totalStars = $progress->sum('stars');
        
        // Niveles totales completados (excluyendo retos 99)
        $totalLevels = $progress->where('level', '<', 90)->where('is_completed', true)->count();

        $this->stats = [
            'completed_worlds' => $completedWorlds,
            'total_stars' => $totalStars,
            'total_levels' => $totalLevels,
            'points' => $this->calculatePoints($progress),
        ];

        // Medallas (Rewards de tipo medal)
        $this->medals = $this->player->rewards->where('type', 'medal');
        
        // Recompensas recientes
        $this->recentRewards = $this->player->rewards->sortByDesc('pivot.earned_at')->take(4);
    }

    protected function calculatePoints($progress)
    {
        // Una fórmula simple de puntos: niveles * 10 + estrellas * 5
        return ($progress->where('is_completed', true)->count() * 10) + ($progress->sum('stars') * 5);
    }

    public function render()
    {
        return view('livewire.game.player-profile');
    }
}
