<?php

namespace App\Livewire\Game;

use Livewire\Component;

class EarTraining extends Component
{
    public $step = 'selection'; // selection, playing
    public $exerciseType = ''; // 'high_low', 'up_down'
    public $score = 0;
    public $totalTrials = 10;
    public $currentTrial = 0;
    public $gameState = 'idle'; // idle, waiting_response, feedback
    
    public $correctAnswer = null;
    public $lastResult = null; // 'correct', 'incorrect'
    
    public $options = [];
    public $currentPitches = [];

    public function selectExercise($type)
    {
        $this->exerciseType = $type;
        $this->step = 'playing';
        $this->startNewTrial();
    }

    public function startNewTrial()
    {
        $this->currentTrial++;
        if ($this->currentTrial > $this->totalTrials) {
            $this->gameState = 'finished';
            return;
        }

        $this->gameState = 'waiting_response';
        $this->lastResult = null;

        if ($this->exerciseType === 'high_low') {
            $this->setupHighLow();
        } elseif ($this->exerciseType === 'up_down') {
            $this->setupUpDown();
        } else {
            $this->setupChords();
        }
    }

    private function setupHighLow()
    {
        $this->options = [
            ['id' => 'high', 'label' => 'Agudo (Pajarito)', 'icon' => '🐦'],
            ['id' => 'low', 'label' => 'Grave (Elefante)', 'icon' => '🐘']
        ];

        $isHigh = rand(0, 1) === 1;
        $this->correctAnswer = 'high' ?: 'low';
        $this->correctAnswer = $isHigh ? 'high' : 'low';
        
        // Rango dinámico
        $notes = ['C', 'D', 'E', 'F', 'G', 'A', 'B'];
        $base = $notes[array_rand($notes)];
        $pitch = $isHigh ? $base . '5' : $base . '2';
        
        $this->currentPitches = [$pitch];
        $this->dispatch('play-pitches', pitches: $this->currentPitches);
    }

    private function setupUpDown()
    {
        $this->options = [
            ['id' => 'up', 'label' => 'Sube 🔼', 'icon' => '🧗'],
            ['id' => 'down', 'label' => 'Baja 🔽', 'icon' => '🤿']
        ];

        $isUp = rand(0, 1) === 1;
        $this->correctAnswer = $isUp ? 'up' : 'down';

        $notes = ['C4', 'D4', 'E4', 'F4', 'G4', 'A4', 'B4', 'C5'];
        $idx1 = rand(0, count($notes) - 3);
        $idx2 = rand($idx1 + 1, count($notes) - 1);

        if ($isUp) {
            $this->currentPitches = [$notes[$idx1], $notes[$idx2]];
        } else {
            $this->currentPitches = [$notes[$idx2], $notes[$idx1]];
        }

        $this->dispatch('play-pitches', pitches: $this->currentPitches);
    }

    private function setupChords()
    {
        $this->options = [
            ['id' => 'major', 'label' => 'Feliz / Brillante', 'icon' => '☀️'],
            ['id' => 'minor', 'label' => 'Triste / Serio', 'icon' => '☁️']
        ];

        $isMajor = rand(0, 1) === 1;
        $this->correctAnswer = $isMajor ? 'major' : 'minor';

        // Definición de notas para tríadas (Simplificado para el motor MIDI-JS)
        $roots = [
            'C4' => ['E4', 'G4', 'Eb4'],
            'D4' => ['Gb4', 'A4', 'F4'],
            'E4' => ['Ab4', 'B4', 'G4'],
            'F4' => ['A4', 'C5', 'Ab4'],
            'G4' => ['B4', 'D5', 'Bb4'],
            'A4' => ['Db5', 'E5', 'C5'],
        ];

        $root = array_rand($roots);
        $thirdMajor = $roots[$root][0];
        $fifth = $roots[$root][1];
        $thirdMinor = $roots[$root][2];

        if ($isMajor) {
            $this->currentPitches = [$root, $thirdMajor, $fifth];
        } else {
            $this->currentPitches = [$root, $thirdMinor, $fifth];
        }

        $this->dispatch('play-pitches', pitches: $this->currentPitches, isChord: true);
    }

    public function playAgain()
    {
        $this->dispatch('play-pitches', pitches: $this->currentPitches);
    }

    public function submitAnswer($id)
    {
        if ($this->gameState !== 'waiting_response') return;

        if ($id === $this->correctAnswer) {
            $this->score++;
            $this->lastResult = 'correct';
            $this->dispatch('play-success-sound');
        } else {
            $this->lastResult = 'incorrect';
            $this->dispatch('play-error-sound');
        }

        $this->gameState = 'feedback';
    }

    public function nextTrial()
    {
        $this->startNewTrial();
    }

    public function resetGame()
    {
        $this->step = 'selection';
        $this->currentTrial = 0;
        $this->score = 0;
        $this->gameState = 'idle';
    }

    public function render()
    {
        return view('livewire.game.ear-training');
    }
}
