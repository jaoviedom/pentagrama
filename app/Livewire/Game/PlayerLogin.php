<?php

namespace App\Livewire\Game;

use App\Models\Player;
use App\Models\User;
use App\Services\PlayerService;
use Livewire\Component;

class PlayerLogin extends Component
{
    public $nicknameInput = '';
    public $pinInput = '';

    public function addPinDigit($digit)
    {
        if (strlen($this->pinInput) < 4) {
            $this->pinInput .= $digit;
        }
    }

    public function clearPin()
    {
        $this->pinInput = '';
    }

    public function login()
    {
        $this->validate([
            'nicknameInput' => 'required',
            'pinInput' => 'required|digits:4'
        ]);

        $player = Player::where('nickname', $this->nicknameInput)->first();

        if (!$player) {
            session()->flash('error', '¡No encontramos a ese aventurero! Revisa tu nombre. 🕵️‍♂️');
            return;
        }

        $service = new PlayerService();

        if ($service->verifyPin($player, $this->pinInput)) {
            $service->recordAccess($player);
            session(['active_player_id' => $player->id]);
            
            // Autenticamos al padre (User) asociado al jugador
            auth()->login($player->user);
            
            return redirect()->route('game.selection');
        } else {
            $this->pinInput = '';
            session()->flash('error', '¡PIN incorrecto! Inténtalo de nuevo 🧐');
        }
    }

    public function render()
    {
        return view('livewire.game.player-login')->layout('components.layouts.app');
    }
}
