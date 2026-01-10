<?php

namespace App\Livewire\Game;

use App\Models\Player;
use Livewire\Component;

class AdventureSelection extends Component
{
    public $player;

    public function mount()
    {
        $playerId = session('active_player_id');
        if (!$playerId) {
            return redirect()->route('players.index');
        }
        $this->player = Player::find($playerId);
    }

    public function goToLessons()
    {
        return redirect()->route('game.lessons');
    }

    public function goToPlay()
    {
        return redirect()->route('game.map');
    }

    public function render()
    {
        return view('livewire.game.adventure-selection');
    }
}
