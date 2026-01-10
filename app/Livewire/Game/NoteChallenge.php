<?php

namespace App\Livewire\Game;

use App\Models\Player;
use App\Services\GameService;
use Livewire\Component;

use Livewire\Attributes\Locked;

class NoteChallenge extends Component
{
    #[Locked]
    public $player;
    
    public $world; // 'sol' or 'fa'
    
    // Game State
    public $gameType; // 'name_selection', 'line_space', 'motion', 'ledger_count'
    public $currentChallenge = [
        'question' => '',
        'notes' => [],
        'options' => [],
        'correct' => ''
    ];
    public $usedChallenges = []; // Historial de preguntas para evitar repetición
    public $score = 0;
    public $attempts = 0;
    public $maxAttempts = 10;
    public $isGameOver = false;
    public $feedback = null; // ['type' => 'success/error', 'message' => '...']
    
    protected $noteNames = [
        'C' => 'Do', 'D' => 'Re', 'E' => 'Mi', 'F' => 'Fa',
        'G' => 'Sol', 'A' => 'La', 'B' => 'Si'
    ];

    public function mount($world = 'sol')
    {
        $playerId = session('active_player_id');
        if (!$playerId) return redirect()->route('players.index');
        
        $this->player = Player::findOrFail($playerId);
        $this->world = $world;
        $this->generateChallenge();
    }

    public function generateChallenge()
    {
        $this->feedback = null;
        $maxTries = 10;
        $try = 0;

        do {
            $types = ['name_selection', 'line_space', 'motion', 'ledger_count'];
            $this->gameType = $types[array_rand($types)];
            
            $notesSol = ['C4', 'D4', 'E4', 'F4', 'G4', 'A4', 'B4', 'C5', 'D5', 'E5', 'F5', 'G5'];
            $notesFa = ['F2', 'G2', 'A2', 'B2', 'C3', 'D3', 'E3', 'F3', 'G3', 'A3', 'B3'];
            $allPossibleNotes = $this->world === 'sol' ? $notesSol : $notesFa;

            switch ($this->gameType) {
                case 'name_selection':
                    $note = $allPossibleNotes[array_rand($allPossibleNotes)];
                    $correctName = $this->noteNames[substr($note, 0, 1)];
                    $options = [$correctName];
                    while(count($options) < 4) {
                        $randomName = $this->noteNames[array_rand($this->noteNames)];
                        if(!in_array($randomName, $options)) $options[] = $randomName;
                    }
                    shuffle($options);
                    
                    $newChallenge = [
                        'question' => '¿Cómo se llama esta nota?',
                        'notes' => [['pitch' => $note, 'highlighted' => false]],
                        'options' => $options,
                        'correct' => $correctName
                    ];
                    break;

                case 'line_space':
                    $note = $allPossibleNotes[array_rand($allPossibleNotes)];
                    $renderer = new \App\Livewire\Game\StaffRenderer();
                    $renderer->clef = $this->world;
                    $pos = $renderer->getNotePosition($note);
                    $correct = ($pos % 2 === 0) ? 'Línea' : 'Espacio';

                    $newChallenge = [
                        'question' => '¿Esta nota está en una línea o en un espacio?',
                        'notes' => [['pitch' => $note, 'highlighted' => false]],
                        'options' => ['Línea', 'Espacio'],
                        'correct' => $correct
                    ];
                    break;

                case 'motion':
                    $note1 = $allPossibleNotes[array_rand($allPossibleNotes)];
                    $note2 = $allPossibleNotes[array_rand($allPossibleNotes)];
                    while($note1 === $note2) $note2 = $allPossibleNotes[array_rand($allPossibleNotes)];
                    
                    $renderer = new \App\Livewire\Game\StaffRenderer();
                    $renderer->clef = $this->world;
                    $correct = ($renderer->getNotePosition($note2) > $renderer->getNotePosition($note1)) ? 'Sube ⬆️' : 'Baja ⬇️';

                    $newChallenge = [
                        'question' => '¿La segunda nota sube o baja?',
                        'notes' => [
                            ['pitch' => $note1, 'highlighted' => false],
                            ['pitch' => $note2, 'highlighted' => false]
                        ],
                        'options' => ['Sube ⬆️', 'Baja ⬇️'],
                        'correct' => $correct
                    ];
                    break;

                case 'ledger_count':
                    if($this->world === 'sol') {
                        $ledgerNotes = ['C4', 'A5', 'G3'];
                    } else {
                        $ledgerNotes = ['E2', 'D2', 'B3']; 
                    }
                    $note = $ledgerNotes[array_rand($ledgerNotes)];
                    
                    $renderer = new \App\Livewire\Game\StaffRenderer();
                    $renderer->clef = $this->world;
                    $pos = $renderer->getNotePosition($note);
                    
                    $correct = 0;
                    if ($pos <= -2) $correct = floor(abs($pos) / 2);
                    if ($pos >= 10) $correct = floor(($pos - 8) / 2);

                    $newChallenge = [
                        'question' => '¿Cuántas líneas adicionales tiene esta nota?',
                        'notes' => [['pitch' => $note, 'highlighted' => false]],
                        'options' => ['0', '1', '2'],
                        'correct' => (string)$correct
                    ];
                    break;
            }

            // Crear una firma única de la pregunta para evitar repeticiones
            $noteSignature = collect($newChallenge['notes'])->pluck('pitch')->join('-');
            $challengeSignature = "{$this->gameType}:{$noteSignature}";
            
            $isDuplicate = in_array($challengeSignature, $this->usedChallenges);
            $try++;

        } while ($isDuplicate && $try < $maxTries);

        $this->usedChallenges[] = $challengeSignature;
        $this->currentChallenge = $newChallenge;
    }

    public function checkAnswer($answer)
    {
        $this->attempts++;
        
        if ($answer === $this->currentChallenge['correct']) {
            $this->score++;
            $this->feedback = [
                'type' => 'success',
                'message' => '¡Excelente! ⭐ Lo has logrado.'
            ];
            $this->currentChallenge['notes'][0]['highlighted'] = true;
            $this->dispatch('playSuccessSound', pitch: $this->currentChallenge['notes'][0]['pitch']);
        } else {
            $this->feedback = [
                'type' => 'error',
                'message' => '¡Casi! Inténtalo de nuevo, tú puedes.'
            ];
            $this->dispatch('playErrorSound');
        }

        if ($this->attempts >= $this->maxAttempts) {
            $this->isGameOver = true;
            // Guardamos progreso si se acertó al menos el 70% (7 de 10)
            if($this->score >= 7) {
                $service = new GameService();
                $service->completeLevel($this->player, $this->world, 99, 3); // Nivel especial 99 para desafíos
            }
        } else {
            // Wait a bit and next challenge
            $this->dispatch('nextChallengeTimer');
        }
    }

    public function nextChallenge()
    {
        if (!$this->isGameOver) {
            $this->generateChallenge();
        }
    }

    public function resetGame()
    {
        $this->score = 0;
        $this->attempts = 0;
        $this->isGameOver = false;
        $this->usedChallenges = []; // Reiniciamos el historial para la nueva partida
        $this->generateChallenge();
    }

    public function render()
    {
        return view('livewire.game.note-challenge');
    }
}
