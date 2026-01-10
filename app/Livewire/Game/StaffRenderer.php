<?php

namespace App\Livewire\Game;

use Livewire\Component;

use Livewire\Attributes\Reactive;

class StaffRenderer extends Component
{
    #[Reactive]
    public $clef = 'sol'; 
    
    #[Reactive]
    public $activeNotes = [];

    public $showNames = true;
    public $interactive = false;
    public $minimal = false;

    public function emitNoteClick($pitch)
    {
        if ($this->interactive) {
            $this->dispatch('notePlaced', $pitch);
        }
    }

    protected function getMapping()
    {
        if ($this->clef === 'sol') {
            return [
                'G3' => -5, 'A3' => -4, 'B3' => -3, 'C4' => -2, 'D4' => -1,
                'E4' => 0, 'F4' => 1, 'G4' => 2, 'A4' => 3, 'B4' => 4,
                'C5' => 5, 'D5' => 6, 'E5' => 7, 'F5' => 8, 'G5' => 9, 'A5' => 10, 'B5' => 11,
            ];
        }

        return [
            'B1' => -5, 'C2' => -4, 'D2' => -3, 'E2' => -2, 'F2' => -1, 'G2' => 0,
            'A2' => 1, 'B2' => 2, 'C3' => 3, 'D3' => 4, 'E3' => 5,
            'F3' => 6, 'G3' => 7, 'A3' => 8, 'B3' => 9, 'C4' => 10,
        ];
    }

    public function getNotePosition($pitch)
    {
        if (!$pitch) return 0;
        $mapping = $this->getMapping();
        return $mapping[$pitch] ?? 0;
    }

    public function getNoteName($pitch)
    {
        if (!$pitch) return '';
        $names = [
            'C' => 'Do', 'D' => 'Re', 'E' => 'Mi', 'F' => 'Fa',
            'G' => 'Sol', 'A' => 'La', 'B' => 'Si',
        ];

        $char = substr($pitch, 0, 1);
        return $names[$char] ?? $char;
    }

    public function render()
    {
        return view('livewire.game.staff-renderer');
    }
}
