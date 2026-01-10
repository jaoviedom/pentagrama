<?php

namespace App\Livewire;

use Livewire\Component;

use App\Services\UserService;

class UserProfile extends Component
{
    public $nombre_completo;
    public $username;
    public $rol;

    public function mount()
    {
        $user = auth()->user();
        $this->nombre_completo = $user->nombre_completo;
        $this->username = $user->username;
        $this->rol = $user->rol;
    }

    public function updateProfile(UserService $userService)
    {
        $this->validate([
            'nombre_completo' => 'required|min:3',
        ]);

        $userService->updateUser(auth()->user(), [
            'nombre_completo' => $this->nombre_completo,
        ]);

        session()->flash('message', '¡Perfil actualizado con éxito! ✨');
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
