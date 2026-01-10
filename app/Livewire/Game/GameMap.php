<?php

namespace App\Livewire\Game;

use App\Models\Player;
use App\Services\GameService;
use Livewire\Component;

class GameMap extends Component
{
    public $world = 'sol'; // 'sol' o 'fa'
    public $player;

    public function mount(GameService $gameService)
    {
        $playerId = session('active_player_id');
        
        if (!$playerId) {
            return redirect()->route('players.index');
        }

        $this->player = Player::findOrFail($playerId);
    }

    public function setWorld($world)
    {
        $this->world = $world;
    }

    public function playLevel($level)
    {
        return redirect()->route('game.lesson', ['world' => $this->world, 'level' => $level]);
    }

    public function render(GameService $gameService)
    {
        $progress = $gameService->getPlayerProgress($this->player, $this->world);
        $lastPlayed = $gameService->getLastPlayedLevel($this->player);
        $worldsConfig = GameService::WORLDS;

        return view('livewire.game.game-map', [
            'levels' => $progress,
            'lastPlayed' => $lastPlayed,
            'worldName' => $worldsConfig[$this->world]['name'],
            'worldColor' => $worldsConfig[$this->world]['color'],
        ]);
    }
}
