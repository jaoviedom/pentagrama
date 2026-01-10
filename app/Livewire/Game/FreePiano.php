<?php

namespace App\Livewire\Game;

use Livewire\Component;

class FreePiano extends Component
{
    public $clef = 'sol'; // 'sol' or 'fa'
    public $lastNote = null;

    public function setClef($clef)
    {
        $this->clef = $clef;
    }

    public function playNote($pitch)
    {
        $this->lastNote = $pitch;
    }

    public function render()
    {
        return view('livewire.game.free-piano');
    }
}
