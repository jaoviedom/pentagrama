<?php

namespace App\Livewire\Players;

use App\Services\PlayerService;
use Livewire\Component;

class CreatePlayer extends Component
{
    public $nickname;
    public $avatar = '🐻';
    public $color = '#a855f7'; // purple-500
    public $pin;
    public $pin_confirmation;

    public $avatars = ['🐶', '🐱', '🐒', '🐰', '🐻', '🦁', '🐘', '🦒', '🦓', '🐼', '🐨', '🐯', '🦄', '🐲', '🦖', '🦊'];
    public $colors = [
        '#ef4444', // red-500
        '#f97316', // orange-500
        '#f59e0b', // amber-500
        '#10b981', // emerald-500
        '#06b6d4', // cyan-500
        '#3b82f6', // blue-500
        '#6366f1', // indigo-500
        '#a855f7', // purple-500
        '#ec4899', // pink-500
    ];

    protected $rules = [
        'nickname' => 'required|min:2|max:20',
        'avatar' => 'required',
        'color' => 'required',
        'pin' => 'required|digits:4',
        'pin_confirmation' => 'required_with:pin|same:pin',
    ];

    public function save(PlayerService $playerService)
    {
        $this->validate();

        $playerService->createPlayer(auth()->user(), [
            'nickname' => $this->nickname,
            'avatar' => $this->avatar,
            'color' => $this->color,
            'pin' => $this->pin,
        ]);

        $this->dispatch('playerCreated');
        $this->reset(['nickname', 'pin', 'pin_confirmation']);
        session()->flash('message', '¡Jugador creado con éxito! 🎈');
    }

    public function render()
    {
        return view('livewire.players.create-player');
    }
}
