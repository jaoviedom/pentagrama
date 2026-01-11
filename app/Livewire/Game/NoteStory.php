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
                'title' => 'Exploradores del Pentagrama',
                'content' => 'Había una vez un pueblo musical llamado Exploradores del Pentagrama, donde vivía la sabia Clave de Sol, una figura curva y brillante con un sombrero puntiagudo.',
                'icon' => '✨',
                'bg' => 'from-purple-500 to-indigo-600',
                'character' => '🎼'
            ],
            [
                'title' => 'La Guardiana',
                'content' => 'Ella era la guardiana del Gran Pentagrama, cinco líneas paralelas como escaleras infinitas, y un día convocó a todas las notas para que aprendieran sus posiciones.',
                'icon' => '𝄖',
                'bg' => 'from-blue-400 to-blue-600',
                'character' => '🧙‍♀️'
            ],
            [
                'title' => 'La Casa de 5 Pisos',
                'content' => 'La Clave de Sol se colocó en la segunda línea, su hogar especial. "Nuestra casa tiene cinco pisos: cuatro espacios y las líneas mismas", les dijo.',
                'icon' => '𝄞',
                'bg' => 'from-yellow-400 to-orange-500',
                'character' => '🏠'
            ],
            [
                'title' => 'Do y Re: Los Cimientos',
                'content' => 'Do vive debajo del pentagrama en su propia línea añadida. Re espera en el primer espacio justo abajo. "¡Do abajo bajo, Re en espacio!", cantó la Clave.',
                'icon' => '🔴',
                'bg' => 'from-red-400 to-red-600',
                'character' => '⚓'
            ],
            [
                'title' => 'Mi, Fa y Sol: ¡Subiendo!',
                'content' => 'Mi en la Línea 1, Fa en el Espacio 2 y Sol en la Línea 2. "¡Mi línea primera, Fa arriba va, Sol en mi corona!", exclamó feliz.',
                'icon' => '🟠',
                'bg' => 'from-orange-400 to-orange-600',
                'character' => '☀️'
            ],
            [
                'title' => 'La, Si y Do Agudo',
                'content' => 'La en el Espacio 3, Si en la Línea 3 y Do agudo en el Espacio 4. "¡La en el medio, Si línea alta, Do al cielo va!", corearon todas.',
                'icon' => '🟡',
                'bg' => 'from-yellow-300 to-yellow-500',
                'character' => '☁️'
            ],
            [
                'title' => '¡Fiesta Musical!',
                'content' => 'De repente, violines y flautas tocaron la escala completa. ¡Las notas saltaron de posición en posición creando la sinfonía más hermosa del mundo!',
                'icon' => '🎻',
                'bg' => 'from-pink-400 to-rose-500',
                'character' => '🎉'
            ],
            [
                'title' => 'El Secreto Eterno',
                'content' => 'Desde ese día, en Exploradores del Pentagrama, cada nota sabe su lugar perfecto para brillar. ¡Ahora tú también conoces el secreto de la música!',
                'icon' => '🎶',
                'bg' => 'from-teal-400 to-emerald-500',
                'character' => '⭐'
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
