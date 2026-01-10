<?php

namespace App\Livewire\Game;

use Livewire\Component;

class LessonsLibrary extends Component
{
    public $activeConcept = null;
    public $concepts = [];

    public function mount()
    {
        $this->concepts = [
            [
                'id' => 'pentagrama',
                'title' => 'El Pentagrama',
                'subtitle' => 'La casita de las notas',
                'icon' => '🎼',
                'bg' => 'from-blue-400 to-indigo-500',
                'description' => 'El pentagrama es como una casita de 5 pisos (líneas) y 4 espacios donde viven las notas musicales.',
                'fact' => '¡Siempre se cuenta de abajo hacia arriba!',
                'animation' => 'staff-intro'
            ],
            [
                'id' => 'clave-sol',
                'title' => 'Clave de Sol',
                'subtitle' => 'La Reina del Brillo',
                'icon' => '𝄞',
                'bg' => 'from-yellow-400 to-orange-500',
                'description' => 'Es la jefa de las notas agudas. Empieza a dibujarse en la segunda línea, ¡por eso esa línea se llama Sol!',
                'fact' => 'La usan instrumentos como el violín y la flauta.',
                'animation' => 'clef-sol-glow'
            ],
            [
                'id' => 'clave-fa',
                'title' => 'Clave de Fa',
                'subtitle' => 'El Abuelo Sabio',
                'icon' => '𝄢',
                'bg' => 'from-indigo-500 to-purple-600',
                'description' => 'Se encarga de las notas más graves y profundas. Sus dos puntitos abrazan la cuarta línea, ¡la nota Fa!',
                'fact' => '¡Es la que le da fuerza y ritmo a la música!',
                'animation' => 'clef-fa-deep'
            ],
            [
                'id' => 'notas',
                'title' => 'Las 7 Notas',
                'subtitle' => 'La Escalera Mágica',
                'icon' => '🎹',
                'bg' => 'from-pink-400 to-rose-500',
                'description' => 'Do, Re, Mi, Fa, Sol, La y Si. ¡Son como los colores del arcoíris pero para tus oídos!',
                'fact' => 'Después del Si, la escalera vuelve a empezar en Do.',
                'animation' => 'scale-bounce'
            ],
        ];
    }

    public function selectConcept($id)
    {
        $this->activeConcept = collect($this->concepts)->firstWhere('id', $id);
    }

    public function closeConcept()
    {
        $this->activeConcept = null;
    }

    public function render()
    {
        return view('livewire.game.lessons-library');
    }
}
