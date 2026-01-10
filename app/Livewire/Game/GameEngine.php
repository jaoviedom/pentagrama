<?php

namespace App\Livewire\Game;

use App\Models\Player;
use App\Services\GameService;
use Livewire\Component;

use Livewire\Attributes\On;

class GameEngine extends Component
{
    public $player;
    public $world;
    public $level;
    
    public $notes = [];
    public $currentIndex = 0;
    public $lives = 3;
    public $gameState = 'waiting'; // 'waiting', 'playing', 'won', 'lost'
    public $stars = 0;
    public $hint = null;

    public function mount($world, $level)
    {
        $playerId = session('active_player_id');
        if (!$playerId) return redirect()->route('players.index');
        
        $this->player = Player::findOrFail($playerId);
        $this->world = $world;
        $this->level = (int)$level;
        
        $this->initGame();
    }

    public function initGame()
    {
        $gameService = new GameService();
        $this->notes = $gameService->generateLevelNotes($this->world, $this->level);
        $this->currentIndex = 0;
        $this->lives = 3;
        $this->gameState = 'waiting';
        $this->stars = 0;
        $this->hint = null;
    }

    public function startGame()
    {
        $this->gameState = 'playing';
    }

    #[On('notePlaced')]
    public function placeNote($pitch)
    {
        if ($this->level <= 30) return; // Solo activo para niveles 31-40
        $this->submitNote($pitch);
    }

    public function submitNote($pitch)
    {
        if ($this->gameState !== 'playing') return;

        $expectedNote = $this->notes[$this->currentIndex]['pitch'];

        // Comparamos solo la base de la nota (ej: 'C' de 'C4' o 'C5')
        $expectedBase = substr($expectedNote, 0, 1);
        $submittedBase = substr($pitch, 0, 1);

        // En niveles > 30, la comparación es más estricta: debe ser el pitch exacto (octava incluida)
        $isCorrect = ($this->level > 30) 
            ? ($pitch === $expectedNote)
            : ($submittedBase === $expectedBase);

        if ($isCorrect) {
            // Acierto
            $this->hint = null;
            $this->notes[$this->currentIndex]['status'] = 'success';
            $this->notes[$this->currentIndex]['highlighted'] = true;
            $this->notes[$this->currentIndex]['hidden'] = false; // Mostrar la nota al acertar
            $this->currentIndex++;
            
            $this->dispatch('playSuccessSound');

            if ($this->currentIndex >= count($this->notes)) {
                $this->calculateStarsAndWin();
            }
        } else {
            // Error o Pista
            if ($this->level > 30 && $submittedBase === $expectedBase) {
                // Pista: Nombre correcto, posición incorrecta
                $names = ['C' => 'Do', 'D' => 'Re', 'E' => 'Mi', 'F' => 'Fa', 'G' => 'Sol', 'A' => 'La', 'B' => 'Si'];
                $this->hint = "¡Casi! Ese es un " . $names[$submittedBase] . ", pero busca en otra posición. 🔍";
                $this->dispatch('playHintSound');
            } else {
                // Error total
                $this->hint = null;
                $this->lives--;
                $this->dispatch('playErrorSound');
                
                if ($this->lives <= 0) {
                    $this->gameState = 'lost';
                }
            }
        }
    }

    protected function calculateStarsAndWin()
    {
        $this->gameState = 'won';
        
        // Estrellas según vidas restantes
        if ($this->lives === 3) $this->stars = 3;
        elseif ($this->lives === 2) $this->stars = 2;
        else $this->stars = 1;

        // Guardar progreso automáticamente
        $gameService = new GameService();
        $gameService->completeLevel($this->player, $this->world, $this->level, $this->stars);

        // Verificar recompensas
        $rewardCode = $gameService->checkRewards($this->player, $this->world, $this->level);
        if ($rewardCode) {
            $this->dispatch('show-reward', rewardCode: $rewardCode);
        }
    }

    public function retry()
    {
        $this->initGame();
        $this->startGame();
    }

    public function nextLevel()
    {
        return redirect()->route('game.lesson', [
            'world' => $this->world, 
            'level' => $this->level + 1
        ]);
    }

    public function render()
    {
        return view('livewire.game.game-engine');
    }
}
