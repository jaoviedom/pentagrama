<?php

namespace App\Livewire\Game;

use App\Models\Player;
use App\Services\GameService;
use Livewire\Component;
use Livewire\Attributes\On;

/**
 * Motor de Juego Principal: Controla el flujo de las lecciones interactivas.
 */
class GameEngine extends Component
{
    // Estado del Jugador y Mundo
    public $player;
    public $world;
    public $level;
    
    // Estado de la Partida
    public $notes = [];
    public $currentIndex = 0;
    public $lives = 3;
    public $gameState = 'waiting'; // waiting, playing, won, lost
    public $stars = 0;
    public $hint = null;
    public $startTime;
    public $isLastLevel = false;
    public $names = ['C' => 'Do', 'D' => 'Re', 'E' => 'Mi', 'F' => 'Fa', 'G' => 'Sol', 'A' => 'La', 'B' => 'Si'];

    /**
     * Inicialización del componente con validación de seguridad.
     */
    public function mount($world, $level)
    {
        $playerId = session('active_player_id');
        if (!$playerId) {
            return redirect()->route('players.index');
        }
        
        $this->player = Player::find($playerId);
        
        // Verificación de integridad: si el jugador no existe por alguna razón
        if (!$this->player) {
            session()->forget('active_player_id');
            return redirect()->route('players.index');
        }

        $this->world = $world;
        $this->level = (int)$level;
        
        // Validación de nivel máximo: si intentan ir más allá de 60, al mapa
        $maxLevels = GameService::WORLDS[$this->world]['levels'] ?? 60;
        if ($this->level > $maxLevels) {
            return redirect()->route('game.map');
        }

        $this->isLastLevel = ($this->level >= $maxLevels);
        
        $this->initGame();
    }

    /**
     * Prepara el estado inicial del juego para un nivel.
     */
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

    /**
     * Cambia el estado a 'playing' para ocultar el banner inicial.
     */
    public function startGame()
    {
        $this->gameState = 'playing';
        $this->startTime = microtime(true);
    }

    /**
     * Escuchador para la ubicación manual de notas (Niveles 31-40).
     */
    #[On('notePlaced')]
    public function placeNote($pitch)
    {
        // Solo respondemos a este evento en niveles interactivos avanzados
        if ($this->level > 30) {
            $this->submitNote($pitch);
        }
    }

    /**
     * Procesa la respuesta del usuario y actualiza el estado del juego.
     */
    public function submitNote($pitch)
    {
        if ($this->gameState !== 'playing') return;

        $expectedNoteData = $this->notes[$this->currentIndex];
        $expectedPitch = $expectedNoteData['pitch'];

        // Lógica de validación simplificada vs estricta
        $expectedNoteName = substr($expectedPitch, 0, 1);
        $submittedNoteName = substr($pitch, 0, 1);

        // En niveles avanzados (>30) validamos la octava exacta. 
        // En niveles básicos validamos solo el nombre de la nota.
        $isCorrect = ($this->level > 30) 
            ? ($pitch === $expectedPitch)
            : ($submittedNoteName === $expectedNoteName);

        if ($isCorrect) {
            $this->handleSuccess($expectedPitch);
        } else {
            $this->handleFailure($submittedNoteName, $expectedNoteName);
        }
    }

    /**
     * Gestiona un acierto del usuario.
     */
    protected function handleSuccess($expectedPitch)
    {
        $this->hint = null;
        $this->notes[$this->currentIndex]['status'] = 'success';
        $this->notes[$this->currentIndex]['highlighted'] = true;
        // Revelamos la nota si estaba oculta (niveles avanzados)
        $this->notes[$this->currentIndex]['hidden'] = false;
        
        $this->currentIndex++;
        $this->dispatch('playSuccessSound', pitch: $expectedPitch);

        // ¿Ganó la partida?
        if ($this->currentIndex >= count($this->notes)) {
            $this->finalizeWin();
        }
    }

    /**
     * Gestiona un error del usuario, proporcionando pistas si es necesario.
     */
    protected function handleFailure($submittedName, $expectedName)
    {
        // Pista pedagógica: Si acertó la nota pero falló la octava (niveles > 30)
        if ($this->level > 30 && $submittedName === $expectedName) {
            $this->hint = "¡Bien! Es un " . $this->names[$submittedName] . ", pero búscalo en otra posición. 🔍";
            $this->dispatch('playHintSound');
        } else {
            // Error común
            $this->hint = null;
            $this->lives--;
            $this->dispatch('playErrorSound');

            // Seguimiento pedagógico: Registrar el error
            \App\Models\GameLog::create([
                'player_id' => $this->player->id,
                'world' => $this->world,
                'level' => $this->level,
                'event_type' => 'error',
                'data' => ['pitch' => $this->notes[$this->currentIndex]['pitch']]
            ]);
            
            if ($this->lives <= 0) {
                $this->gameState = 'lost';
            }
        }
    }

    /**
     * Calcula estrellas, guarda progreso y verifica recompensas sorpresa.
     */
    protected function finalizeWin()
    {
        $this->gameState = 'won';
        
        // Puntuación de estrellas basada en el rendimiento
        $this->stars = match($this->lives) {
            3 => 3,
            2 => 2,
            default => 1,
        };

        // Registro pedagógico: Nivel completado y duración
        $duration = round(microtime(true) - ($this->startTime ?? microtime(true)));
        \App\Models\GameLog::create([
            'player_id' => $this->player->id,
            'world' => $this->world,
            'level' => $this->level,
            'event_type' => 'level_complete',
            'data' => ['duration' => $duration]
        ]);

        $gameService = new GameService();
        $gameService->completeLevel($this->player, $this->world, $this->level, $this->stars);

        // Gamificación: ¿Ganó algo nuevo?
        $rewardCode = $gameService->checkRewards($this->player, $this->world, $this->level);
        if ($rewardCode) {
            $this->dispatch('show-reward', rewardCode: $rewardCode);
        }

        // Si es el último nivel, disparamos confetti
        if ($this->isLastLevel) {
            $this->dispatch('celebrate-victory');
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
