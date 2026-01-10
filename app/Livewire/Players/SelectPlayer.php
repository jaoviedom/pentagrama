<?php

namespace App\Livewire\Players;

use App\Models\Player;
use App\Services\PlayerService;
use Livewire\Component;

class SelectPlayer extends Component
{
    public $selectedPlayerId;
    public $pinInput = '';
    public $step = 'selection'; // selection, pin

    protected $listeners = ['playerCreated' => '$refresh'];

    public function selectPlayer($playerId)
    {
        $this->selectedPlayerId = $playerId;
        $this->step = 'pin';
        $this->pinInput = '';
    }

    public function cancelPin()
    {
        $this->step = 'selection';
        $this->selectedPlayerId = null;
        $this->pinInput = '';
    }

    public function addPinDigit($digit)
    {
        if (strlen($this->pinInput) < 4) {
            $this->pinInput .= $digit;
        }

        if (strlen($this->pinInput) === 4) {
            $this->verifyPin();
        }
    }

    public function clearPin()
    {
        $this->pinInput = '';
    }

    public function verifyPin()
    {
        $player = Player::findOrFail($this->selectedPlayerId);
        $service = new PlayerService();

        if ($service->verifyPin($player, $this->pinInput)) {
            $service->recordAccess($player);
            
            // Aquí se guardaría en sesión al jugador activo
            session(['active_player_id' => $player->id]);
            
            return redirect()->route('game.map');
        } else {
            $this->pinInput = '';
            session()->flash('error', '¡PIN incorrecto! Inténtalo de nuevo 🧐');
        }
    }

    public function render()
    {
        return view('livewire.players.select-player', [
            'players' => auth()->user()->players()->orderBy('last_access_at', 'desc')->get()
        ]);
    }
}
