<?php

namespace App\Livewire\Players;

use App\Models\Player;
use App\Services\PlayerService;
use Livewire\Component;

/**
 * Componente de Selección de Jugador: Gestiona el login infantil mediante PIN.
 */
class SelectPlayer extends Component
{
    public $selectedPlayerId;
    public $pinInput = '';
    public $step = 'selection'; // 'selection' muestra avatares, 'pin' muestra el teclado

    protected $listeners = ['playerCreated' => '$refresh'];

    /**
     * Prepara la entrada de PIN para un jugador específico.
     */
    public function selectPlayer($playerId)
    {
        $this->selectedPlayerId = $playerId;
        $this->step = 'pin';
        $this->pinInput = '';
    }

    /**
     * Regresa a la lista de avatares.
     */
    public function cancelPin()
    {
        $this->step = 'selection';
        $this->selectedPlayerId = null;
        $this->pinInput = '';
    }

    /**
     * Gestiona la entrada del teclado numérico virtual.
     */
    public function addPinDigit($digit)
    {
        if (strlen($this->pinInput) < 4) {
            $this->pinInput .= $digit;
        }

        // Validación automática al completar los 4 dígitos
        if (strlen($this->pinInput) === 4) {
            $this->verifyPin();
        }
    }

    public function clearPin()
    {
        $this->pinInput = '';
    }

    /**
     * Verifica el PIN usando el servicio de jugadores y gestiona el acceso.
     */
    public function verifyPin()
    {
        $player = Player::findOrFail($this->selectedPlayerId);
        $service = new PlayerService();

        if ($service->verifyPin($player, $this->pinInput)) {
            // Éxito: Guardamos en sesión y actualizamos última conexión
            $service->recordAccess($player);
            session(['active_player_id' => $player->id]);
            
            return redirect()->route('game.map');
        } else {
            // Error: Feedback visual y reset de entrada
            $this->pinInput = '';
            session()->flash('error', '¡PIN incorrecto! Inténtalo de nuevo 🧐');
        }
    }

    public function render()
    {
        return view('livewire.players.select-player', [
            'players' => auth()->user()->players()->orderBy('last_access_at', 'desc')->get()
        ]);
    }
}
