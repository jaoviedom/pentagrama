<?php

namespace App\Livewire\Game;

use App\Models\Player;
use App\Models\Reward;
use App\Services\GameService;
use Livewire\Component;

class SpeedChallenge extends Component
{
    public $player;
    public $world;
    
    // Estado del Juego
    public $gameState = 'waiting'; // 'waiting', 'playing', 'finished'
    public $timeLeft = 60;
    public $score = 0;
    public $totalHits = 0;
    public $combo = 0;
    public $maxCombo = 0;
    public $multiplier = 1;
    public $highScore = 0;
    
    // Nota actual
    public $currentNote = null;
    public $activeNotes = []; // Solo una nota a la vez para velocidad

    public function mount($world)
    {
        $playerId = session('active_player_id');
        if (!$playerId) return redirect()->route('players.index');
        
        $this->player = Player::findOrFail($playerId);
        $this->world = $world;

        // Cargar récord personal (usamos nivel especial 99 para retos)
        $progress = \App\Models\Progress::where([
            'player_id' => $this->player->id,
            'world' => $this->world,
            'level' => 99
        ])->first();

        $this->highScore = $progress ? $progress->best_score : 0;
    }

    public function startGame()
    {
        $this->score = 0;
        $this->totalHits = 0;
        $this->combo = 0;
        $this->maxCombo = 0;
        $this->multiplier = 1;
        $this->timeLeft = 60;
        $this->gameState = 'playing';
        
        $this->generateNewNote();
    }

    public function generateNewNote()
    {
        $gameService = new GameService();
        // Usamos nivel 30 para tener el rango completo pero con notas VISIBLES
        $notes = $gameService->generateLevelNotes($this->world, 30); 
        $this->currentNote = $notes[0];
        $this->activeNotes = [$this->currentNote];
    }

    public function submitNote($pitch)
    {
        if ($this->gameState !== 'playing') return;

        $expectedBase = substr($this->currentNote['pitch'], 0, 1);
        $submittedBase = substr($pitch, 0, 1);

        if ($submittedBase === $expectedBase) {
            // ACIERTO
            $this->totalHits++;
            $this->combo++;
            $this->maxCombo = max($this->maxCombo, $this->combo);
            
            // Lógica de Multiplicador (cada 5 aciertos sube el multiplicador, max 4x)
            $this->multiplier = min(4, floor($this->combo / 5) + 1);
            
            // Calcular puntos (10 base * multiplicador)
            $this->score += (10 * $this->multiplier);
            
            $this->dispatch('playSuccessSound', pitch: $this->currentNote['pitch']);
            $this->generateNewNote();
        } else {
            // ERROR
            $this->combo = 0;
            $this->multiplier = 1;
            $this->dispatch('playErrorSound');
        }
    }

    public function tick()
    {
        if ($this->gameState !== 'playing') return;

        $this->timeLeft--;

        if ($this->timeLeft <= 0) {
            $this->endGame();
        }
    }

    public function endGame()
    {
        $this->gameState = 'finished';
        $this->activeNotes = [];
        
        // Guardar récord si es superado
        if ($this->score > $this->highScore) {
            $this->highScore = $this->score;
            $gameService = new GameService();
            // Nivel 99 es para retos de velocidad
            $gameService->completeLevel($this->player, $this->world, 99, 0, $this->score);
        }
        
        // Verificar recompensas especiales por velocidad
        $this->checkSpeedRewards();
    }

    protected function checkSpeedRewards()
    {
        // Si hizo más de 300 puntos, premio aleatorio (si no lo tiene)
        if ($this->score >= 300) {
            $gameService = new GameService();
            $rewardCode = $gameService->checkRewards($this->player, $this->world, 40); // Simulamos nivel 40 para retos
            if ($rewardCode) {
                $this->dispatch('show-reward', rewardCode: $rewardCode);
            }
        }
    }

    public function render()
    {
        return view('livewire.game.speed-challenge');
    }
}
