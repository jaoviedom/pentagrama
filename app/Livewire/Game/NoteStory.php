<?php

namespace App\Livewire\Game;

use Livewire\Component;

class NoteStory extends Component
{
    public $currentStep = 0;
    public $totalSteps = 0;
    public $story = [];

    public function mount()
    {
        $this->story = [
            [
                'title' => 'El Gran Castillo del Pentagrama',
                'content' => 'Había una vez una casita mágica de 5 pisos llamada Pentagrama. Allí vivían los sonidos más alegres del mundo.',
                'icon' => '🏰',
                'bg' => 'from-blue-400 to-indigo-500',
                'character' => '🎼'
            ],
            [
                'title' => 'La Reina Sol llega al Trono',
                'content' => 'Un día, la Reina Sol decidió vivir en el segundo piso. Como es muy elegante, ¡donde ella se sienta, todas las notas brillan!',
                'icon' => '𝄞',
                'bg' => 'from-yellow-400 to-orange-500',
                'character' => '☀️'
            ],
            [
                'title' => 'El Abuelo Fa y el Sótano Mágico',
                'content' => 'Pero en los pisos profundos cuidaba el Abuelo Fa. Él prefiere los sonidos bajos y roncos, ¡como un gigante amigable!',
                'icon' => '𝄢',
                'bg' => 'from-indigo-600 to-purple-800',
                'character' => '⚓'
            ],
            [
                'title' => '¡Todos a Jugar!',
                'content' => 'Desde entonces, todas las notas suben y bajan por los pisos y espacios del pentagrama creando las canciones que hoy escuchamos.',
                'icon' => '🎹',
                'bg' => 'from-green-400 to-teal-600',
                'character' => '🎶'
            ],
            [
                'title' => 'Tu Turno de Ser Maestro',
                'content' => 'Ahora que conoces la historia, estás listo para reconocer dónde vive cada nota. ¡Vamos a la aventura!',
                'icon' => '⭐',
                'bg' => 'from-pink-400 to-rose-600',
                'character' => '🦁'
            ]
        ];
        $this->totalSteps = count($this->story);
    }

    public function next()
    {
        if ($this->currentStep < $this->totalSteps - 1) {
            $this->currentStep++;
        } else {
            $this->dispatch('storyFinished');
        }
    }

    public function prev()
    {
        if ($this->currentStep > 0) {
            $this->currentStep--;
        }
    }

    public function render()
    {
        return view('livewire.game.note-story');
    }
}
