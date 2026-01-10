<?php

namespace App\Livewire\Game;

use Livewire\Component;

class FreePiano extends Component
{
    public $clef = 'sol'; // 'sol' or 'fa'
    public $lastNote = null;
    public $history = [];

    public function setClef($clef)
    {
        $this->clef = $clef;
    }

    public function playNote($pitch)
    {
        $this->lastNote = $pitch;
        array_unshift($this->history, [
            'pitch' => $pitch,
            'time' => now()->format('H:i:s')
        ]);
        
        // Keep only the last 10 notes in history view
        if (count($this->history) > 10) {
            array_pop($this->history);
        }
    }

    public function clearHistory()
    {
        $this->history = [];
        $this->lastNote = null;
    }

    public function render()
    {
        return view('livewire.game.free-piano');
    }
}
