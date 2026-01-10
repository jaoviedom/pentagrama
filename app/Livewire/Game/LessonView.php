<?php

namespace App\Livewire\Game;

use App\Models\Player;
use App\Services\GameService;
use Livewire\Component;

class LessonView extends Component
{
    public $player;
    public $world;
    public $level;
    public $currentNotes = [];
    public $currentIndex = -1;
    public $isPlaying = false;

    public function mount($world, $level)
    {
        $playerId = session('active_player_id');
        if (!$playerId) return redirect()->route('players.index');
        
        $this->player = Player::findOrFail($playerId);
        $this->world = $world;
        $this->level = $level;

        // Notas de ejemplo para la lección
        if ($world === 'sol') {
            $this->currentNotes = [
                ['pitch' => 'C4', 'highlighted' => false],
                ['pitch' => 'E4', 'highlighted' => false],
                ['pitch' => 'G4', 'highlighted' => false],
                ['pitch' => 'C5', 'highlighted' => false],
            ];
        } else {
            $this->currentNotes = [
                ['pitch' => 'F2', 'highlighted' => false],
                ['pitch' => 'A2', 'highlighted' => false],
                ['pitch' => 'C3', 'highlighted' => false],
                ['pitch' => 'F3', 'highlighted' => false],
            ];
        }
    }

    public function startLesson()
    {
        $this->isPlaying = true;
        $this->currentIndex = -1;
        $this->resetHighlights();
        // Ya no llamamos a nextNote() aquí para que el primer clic lo de el usuario
    }

    public function resetHighlights()
    {
        foreach ($this->currentNotes as &$note) {
            $note['highlighted'] = false;
        }
    }

    public function nextNote()
    {
        $this->currentIndex++;
        
        if ($this->currentIndex < count($this->currentNotes)) {
            $this->currentNotes[$this->currentIndex]['highlighted'] = true;
            $this->dispatch('playNoteSound');

            // Si es la última nota, completamos automáticamente el nivel
            if ($this->currentIndex === count($this->currentNotes) - 1) {
                // Pequeña pausa opcional o completar directo
                $this->isPlaying = false;
                $this->complete();
            }
        }
    }

    public function complete()
    {
        $service = new GameService();
        $service->completeLevel($this->player, $this->world, $this->level, 3);
        session()->flash('message', '¡Nivel completado! 🌟🌟🌟');
    }

    public function render()
    {
        return view('livewire.game.lesson-view');
    }
}
