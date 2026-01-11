<?php

namespace App\Livewire\Game;

use Livewire\Component;
use Livewire\Attributes\On;

class LessonsMenu extends Component
{
    public $view = 'menu'; // 'menu', 'library', 'story', 'ear-training', 'piano', 'stickers'

    #[On('storyFinished')]
    public function setView($view = 'menu')
    {
        $this->view = $view;
    }

    public function logout()
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.game.lessons-menu');
    }
}
