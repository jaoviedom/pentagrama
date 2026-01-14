<?php

namespace App\Livewire\Guardian;

use App\Models\Player;
use Livewire\Component;
use Illuminate\Validation\Rule;

/**
 * Componente Livewire para la gestión de exploradores (jugadores).
 * 
 * Permite a los guardianes crear, editar, eliminar y seleccionar exploradores.
 * 
 * @example
 * <livewire:guardian.explorer-management />
 */
class ExplorerManagement extends Component
{
    /** @var bool Controla la visibilidad del modal de creación. */
    public $showCreateModal = false;

    /** @var bool Controla la visibilidad del modal de edición. */
    public $showEditModal = false;

    /** @var bool Controla la visibilidad de la confirmación de eliminación. */
    public $confirmingDeletion = false;

    /** @var int|null ID del jugador a eliminar. */
    public $playerIdToDelete;

    // Form fields
    public $nickname;
    public $pin;
    public $avatar = '🐻';
    public $editingPlayerId;

    public $avatars = ['🐶', '🐱', '🐒', '🐰', '🐻', '🦁', '🐘', '🦒', '🦓', '🐼', '🐨', '🐯', '🦄', '🐲', '🦖', '🦊'];

    protected function rules()
    {
        return [
            'nickname' => [
                'required',
                'min:3',
                'max:20',
                Rule::unique('players', 'nickname')
                    ->ignore($this->editingPlayerId)
                    ->where('user_id', auth()->id())
            ],
            'pin' => 'required|digits:4',
            'avatar' => 'required'
        ];
    }

    protected $messages = [
        'nickname.unique' => 'Ya tienes un explorador con este nombre.',
        'pin.digits' => 'El PIN debe ser de exactamente 4 números.',
        'nickname.required' => 'El nombre es obligatorio.',
        'pin.required' => 'El PIN es obligatorio.',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->nickname = '';
        $this->pin = '';
        $this->avatar = '🐻';
        $this->editingPlayerId = null;
        $this->resetErrorBag();
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->showCreateModal = true;
    }

    public function closeModal()
    {
        $this->showCreateModal = false;
        $this->showEditModal = false;
        $this->resetForm();
    }

    /**
     * Crea un nuevo perfil de explorador vinculado al usuario autenticado.
     * 
     * @return void
     * @throws \Illuminate\Validation\ValidationException Si los datos del formulario no son válidos.
     * @example
     * // Dentro del componente:
     * $this->nickname = 'Pianista';
     * $this->pin = '1234';
     * $this->createPlayer();
     */
    public function createPlayer()
    {
        $this->validate();

        auth()->user()->players()->create([
            'nickname' => $this->nickname,
            'pin' => $this->pin,
            'avatar' => $this->avatar,
            'color' => '#8B5CF6'
        ]);

        $this->showCreateModal = false;
        $this->resetForm();
        session()->flash('success', '¡Explorador creado con éxito! 🚀');
    }

    public function editPlayer($id)
    {
        $player = Player::findOrFail($id);
        $this->editingPlayerId = $id;
        $this->nickname = $player->nickname;
        $this->pin = $player->pin;
        $this->avatar = $player->avatar;
        $this->showEditModal = true;
    }

    public function updatePlayer()
    {
        $this->validate();

        $player = Player::findOrFail($this->editingPlayerId);
        $player->update([
            'nickname' => $this->nickname,
            'pin' => $this->pin,
            'avatar' => $this->avatar,
        ]);

        $this->showEditModal = false;
        $this->resetForm();
        session()->flash('success', '¡Perfil actualizado! ✨');
    }

    public function confirmDelete($id)
    {
        $this->playerIdToDelete = $id;
        $this->confirmingDeletion = true;
    }

    public function deletePlayer()
    {
        Player::destroy($this->playerIdToDelete);
        $this->confirmingDeletion = false;
        $this->playerIdToDelete = null;
        session()->flash('success', 'Explorador eliminado. 👋');
    }

    public function playAsPlayer($id)
    {
        $player = Player::findOrFail($id);
        session(['active_player_id' => $player->id]);
        return redirect()->route('game.selection');
    }

    public function render()
    {
        $players = auth()->user()->players()
            ->withCount([
                'progress as completed_lessons' => function ($query) {
                    $query->where('is_completed', true);
                }
            ])
            ->get();

        return view('livewire.guardian.explorer-management', [
            'players' => $players,
            'totalLevels' => 120
        ]);
    }
}
