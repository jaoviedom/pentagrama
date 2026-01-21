<?php

namespace App\Livewire\Game;

use App\Models\Player;
use App\Models\Reward;
use Livewire\Component;

class TrophyCabinet extends Component
{
    public $player;
    public $rewards = [];

    public function mount()
    {
        $playerId = session('active_player_id');
        if (!$playerId)
            return redirect()->route('players.index');

        $this->player = Player::with('rewards')->findOrFail($playerId);

        // Cargar todas las posibles recompensas para mostrar también las que faltan
        $allRewards = Reward::all();

        $earnedIds = $this->player->rewards->pluck('id')->toArray();

        $this->rewards = $allRewards->map(function ($reward) use ($earnedIds) {
            $isEarned = in_array($reward->id, $earnedIds);
            return [
                'id' => $reward->id,
                'name' => $reward->name,
                'type' => $reward->type,
                'description' => $reward->description,
                'icon' => $reward->icon,
                'is_earned' => $isEarned,
                'earned_at' => $isEarned
                    ? $this->player->rewards->where('id', $reward->id)->first()->pivot->earned_at
                    : null
            ];
        })->groupBy('type')->toArray();
    }

    public function render()
    {
        return view('livewire.game.trophy-cabinet');
    }
}
