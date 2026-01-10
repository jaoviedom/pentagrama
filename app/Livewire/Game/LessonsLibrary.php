<?php

namespace App\Livewire\Game;

use Livewire\Component;

class LessonsLibrary extends Component
{
    public $activeConcept = null;
    public $activeCategory = 'Todos';
    public $concepts = [];
    public $categories = ['Todos', 'Fundamentos', 'Ritmo', 'Notas', 'Teoría', 'Técnica'];

    public function mount()
    {
        // Helpers para SVGs musicales
        $svgNote = fn($path) => '<svg viewBox="0 0 100 100" class="w-full h-full fill-current" xmlns="http://www.w3.org/2000/svg">'.$path.'</svg>';
        
        $this->concepts = [
            // 1. FUNDAMENTOS
            [
                'id' => 'pentagrama',
                'category' => 'Fundamentos',
                'title' => 'Pentagrama',
                'subtitle' => 'La casita de 5 pisos',
                'icon' => $svgNote('<path d="M10 20h80M10 40h80M10 60h80M10 80h80M10 100h80" stroke="currentColor" stroke-width="4"/>'),
                'bg' => 'from-blue-400 to-indigo-500',
                'description' => 'Es como una escalera de 5 líneas y 4 espacios donde las notas suben y bajan.',
                'fact' => '¡Penta significa "cinco" en griego!',
                'animation' => 'staff-intro'
            ],
            [
                'id' => 'clave-sol',
                'category' => 'Fundamentos',
                'title' => 'Clave de Sol',
                'subtitle' => 'La jefa de los agudos',
                'icon' => '𝄞',
                'bg' => 'from-yellow-400 to-orange-500',
                'description' => 'Un caracol valiente que nos dice que la segunda línea es la nota Sol.',
                'fact' => 'Es la clave que usan el violín, la flauta y tu mano derecha.',
                'animation' => 'clef-sol-glow'
            ],
            [
                'id' => 'clave-fa',
                'category' => 'Fundamentos',
                'title' => 'Clave de Fa',
                'subtitle' => 'El abuelo de los graves',
                'icon' => '𝄢',
                'bg' => 'from-indigo-500 to-purple-600',
                'description' => 'Marca el camino de los sonidos profundos. Sus dos puntos abrazan la cuarta línea.',
                'fact' => 'La usan el bajo, el violonchelo y tu mano izquierda.',
                'animation' => 'clef-fa-deep'
            ],

            // 2. FIGURAS Y RITMO
            [
                'id' => 'nota',
                'category' => 'Ritmo',
                'title' => 'Nota Musical',
                'subtitle' => 'El átomo de la música',
                'icon' => $svgNote('<ellipse cx="50" cy="70" rx="20" ry="15" transform="rotate(-20 50 70)"/><path d="M70 70V20" stroke="currentColor" stroke-width="6"/>'),
                'bg' => 'from-pink-400 to-rose-500',
                'description' => 'Es un sonido con nombre (como Do o Re). Nos dice qué tan agudo o grave suena.',
                'fact' => 'Ejemplo: La nota DO vive justo debajo de la primera línea en clave de sol.',
                'animation' => 'note-pop'
            ],
            [
                'id' => 'silencio',
                'category' => 'Ritmo',
                'title' => 'Silencio',
                'subtitle' => 'Música calladita',
                'icon' => $svgNote('<path d="M50 20l-10 15 15 10-20 20 15 5-20 20" stroke="currentColor" stroke-width="6" fill="none"/>'),
                'bg' => 'from-slate-400 to-slate-600',
                'description' => 'Es el momento en que los instrumentos descansan. ¡Los silencios también son música!',
                'fact' => 'Sin silencios, ¡la música sería un desorden de ruidos!',
                'animation' => 'hush'
            ],
            [
                'id' => 'negra',
                'category' => 'Ritmo',
                'title' => 'La Negra',
                'subtitle' => 'Un paso seguido',
                'icon' => $svgNote('<ellipse cx="40" cy="75" rx="18" ry="13" transform="rotate(-20 40 75)"/><path d="M58 75V25" stroke="currentColor" stroke-width="6"/>'),
                'bg' => 'from-emerald-500 to-teal-600',
                'description' => 'Dura 1 tiempo. Es como el latido de tu corazón o un paso normal al caminar.',
                'fact' => 'Ejemplo: ¡Tac! ¡Tac! ¡Tac! ¡Tac!',
                'animation' => 'step'
            ],
            [
                'id' => 'blanca',
                'category' => 'Ritmo',
                'title' => 'La Blanca',
                'subtitle' => 'Dos tiempos',
                'icon' => $svgNote('<ellipse cx="40" cy="75" rx="18" ry="13" transform="rotate(-20 40 75)" fill="none" stroke="currentColor" stroke-width="4"/><path d="M58 75V25" stroke="currentColor" stroke-width="6"/>'),
                'bg' => 'from-sky-400 to-blue-500',
                'description' => 'Dura 2 tiempos. Es un sonido largo, como respirar hondo.',
                'fact' => '¡Dura lo mismo que dos negras juntas!',
                'animation' => 'breath'
            ],
            [
                'id' => 'redonda',
                'category' => 'Ritmo',
                'title' => 'La Redonda',
                'subtitle' => 'La reina del tiempo',
                'icon' => $svgNote('<ellipse cx="50" cy="50" rx="35" ry="25" transform="rotate(-20 50 50)" fill="none" stroke="currentColor" stroke-width="6"/><ellipse cx="50" cy="50" rx="15" ry="10" transform="rotate(-20 50 50)" fill="none" stroke="currentColor" stroke-width="4"/>'),
                'bg' => 'from-purple-400 to-fuchsia-500',
                'description' => 'Dura 4 tiempos. Es la figura más larga y majestuosa.',
                'fact' => 'Imagina que dices "Oooooolaaaa" contando hasta 4.',
                'animation' => 'circle-grow'
            ],
            [
                'id' => 'corchea',
                'category' => 'Ritmo',
                'title' => 'Corchea',
                'subtitle' => 'Medio tiempo',
                'icon' => $svgNote('<ellipse cx="40" cy="75" rx="18" ry="13" transform="rotate(-20 40 75)"/><path d="M58 75V25" stroke="currentColor" stroke-width="6"/><path d="M58 25c15 5 25 20 20 40" stroke="currentColor" stroke-width="6" fill="none"/>'),
                'bg' => 'from-orange-400 to-red-500',
                'description' => '¡Son rápidas! Cuando hay dos juntas decimos "corro".',
                'fact' => 'Caben dos corcheas en el tiempo de una negra.',
                'animation' => 'run-fast'
            ],
            [
                'id' => 'semicorchea',
                'category' => 'Ritmo',
                'title' => 'Semicorchea',
                'subtitle' => 'Súper veloz',
                'icon' => $svgNote('<ellipse cx="40" cy="75" rx="18" ry="13" transform="rotate(-20 40 75)"/><path d="M58 75V25" stroke="currentColor" stroke-width="6"/><path d="M58 25c15 5 25 15 20 30M58 40c15 5 25 10 20 25" stroke="currentColor" stroke-width="6" fill="none"/>'),
                'bg' => 'from-yellow-300 to-amber-500',
                'description' => '¡Vuelan como un colibrí! Son 4 veces más rápidas que una negra.',
                'fact' => '¡Caben cuatro en un solo latido!',
                'animation' => 'hummingbird'
            ],

            // 3. ESTRUCTURA Y MÉTRICA
            [
                'id' => 'compas',
                'category' => 'Teoría',
                'title' => 'Compás',
                'subtitle' => 'Las cajas mágicas',
                'icon' => $svgNote('<text x="50" y="45" font-family="Arial" font-weight="900" font-size="40" text-anchor="middle" fill="currentColor">4</text><text x="50" y="85" font-family="Arial" font-weight="900" font-size="40" text-anchor="middle" fill="currentColor">4</text>'),
                'bg' => 'from-indigo-400 to-blue-600',
                'description' => 'Son casillas que dividen la música en partes iguales para que no nos perdamos.',
                'fact' => 'Ejemplo: Un compás de 4/4 tiene espacio para 4 negras.',
                'animation' => 'box-pulse'
            ],
            [
                'id' => 'barra-compas',
                'category' => 'Fundamentos',
                'title' => 'Barra de Compás',
                'subtitle' => 'La pared divisoria',
                'icon' => $svgNote('<path d="M50 10V90" stroke="currentColor" stroke-width="8"/>'),
                'bg' => 'from-gray-300 to-gray-500',
                'description' => 'Es la línea vertical que separa un compás del siguiente.',
                'fact' => '¡Actúa como una valla en una carrera para marcar tramos!',
                'animation' => 'line-draw'
            ],
            [
                'id' => 'doble-barra',
                'category' => 'Fundamentos',
                'title' => 'Doble Barra',
                'subtitle' => 'El gran final',
                'icon' => $svgNote('<path d="M40 10V90M60 10V90" stroke="currentColor" stroke-width="8"/><path d="M60 10V90" stroke="currentColor" stroke-width="15"/>'),
                'bg' => 'from-red-500 to-rose-600',
                'description' => 'Significa que la canción ha terminado. ¡Hora de aplaudir!',
                'fact' => 'Son dos líneas al final de la hoja.',
                'animation' => 'curtain'
            ],
            [
                'id' => 'tempo',
                'category' => 'Ritmo',
                'title' => 'Tempo',
                'subtitle' => '¿Lento o rápido?',
                'icon' => '𝅘𝅥 = 120',
                'bg' => 'from-cyan-400 to-blue-500',
                'description' => 'Es la velocidad de la música. Puede ser lento como tortuga o rápido como conejo.',
                'fact' => 'Se mide con un reloj especial llamado Metrónomo.',
                'animation' => 'clock-tick'
            ],

            // 4. LAS NOTAS
            [
                'id' => 'do-si',
                'category' => 'Notas',
                'title' => 'Las 7 Notas',
                'subtitle' => 'La escalera infinita',
                'icon' => '🎶',
                'bg' => 'from-violet-400 to-purple-600',
                'description' => 'Do, Re, Mi, Fa, Sol, La, Si. Son los nombres de todos los sonidos.',
                'fact' => '¡Van siempre en el mismo orden, subiendo y bajando!',
                'animation' => 'rainbow-wave'
            ],
            [
                'id' => 'octava',
                'category' => 'Notas',
                'title' => 'La Octava',
                'subtitle' => 'Salto espacial',
                'icon' => '𝄇 8 𝄆',
                'bg' => 'from-lime-400 to-emerald-500',
                'description' => 'Es la distancia entre un Do y el siguiente Do más agudo.',
                'fact' => 'Se llama así porque hay 8 notas entre ellas.',
                'animation' => 'jump'
            ],
            [
                'id' => 'sostenido',
                'category' => 'Notas',
                'title' => 'Sostenido',
                'subtitle' => 'Medio paso arriba',
                'icon' => '♯',
                'bg' => 'from-blue-600 to-indigo-800',
                'description' => 'Sube la nota un poquito, como si se pusiera de puntillas.',
                'fact' => 'En el piano, ¡suele ser la tecla negra de la derecha!',
                'animation' => 'sharp-up'
            ],
            [
                'id' => 'bemol',
                'category' => 'Notas',
                'title' => 'Bemol',
                'subtitle' => 'Medio paso abajo',
                'icon' => '♭',
                'bg' => 'from-pink-600 to-rose-800',
                'description' => 'Baja la nota un poquito, como si se agachara un poco.',
                'fact' => 'En el piano, ¡suele ser la tecla negra de la izquierda!',
                'animation' => 'flat-down'
            ],
            [
                'id' => 'becuadro',
                'category' => 'Notas',
                'title' => 'Natural',
                'subtitle' => 'Quita los efectos',
                'icon' => '♮',
                'bg' => 'from-slate-500 to-slate-700',
                'description' => 'Es un borrador mágico que quita el efecto del sostenido y el bemol.',
                'fact' => 'Hace que la nota vuelva a su estado original.',
                'animation' => 'erase'
            ],

            // 5. TEORÍA AVANZADA
            [
                'id' => 'escala-mayor',
                'category' => 'Teoría',
                'title' => 'Escala Mayor',
                'subtitle' => 'Música alegre',
                'icon' => '𝆕',
                'bg' => 'from-yellow-400 to-lime-500',
                'description' => 'Es un grupo de notas que suena brillante y feliz.',
                'fact' => '¡Ejemplo: Do Mayor es la escala más común y alegre!',
                'animation' => 'smile'
            ],
            [
                'id' => 'escala-menor',
                'category' => 'Teoría',
                'title' => 'Escala Menor',
                'subtitle' => 'Misterio o tristeza',
                'icon' => '𝆖',
                'bg' => 'from-indigo-600 to-blue-900',
                'description' => 'Suena más melancólica, nostálgica o incluso tenebrosa.',
                'fact' => 'Muchas canciones de misterio usan escalas menores.',
                'animation' => 'rain'
            ],
            [
                'id' => 'acorde',
                'category' => 'Teoría',
                'title' => 'Acorde',
                'subtitle' => 'Notas amigas',
                'icon' => '𝄫',
                'bg' => 'from-fuchsia-500 to-purple-700',
                'description' => 'Cuando 3 o más notas cantan juntas al mismo tiempo.',
                'fact' => '¡Suena mucho más rico y completo que una nota sola!',
                'animation' => 'unity'
            ],
            [
                'id' => 'triada',
                'category' => 'Teoría',
                'title' => 'Tríada',
                'subtitle' => 'El trío perfecto',
                'icon' => '𝆔',
                'bg' => 'from-orange-500 to-amber-600',
                'description' => 'Un acorde básico formado por 3 notas especiales: 1ª, 3ª y 5ª.',
                'fact' => 'Son la base de casi todas las canciones que escuchas.',
                'animation' => 'triangle'
            ],
            [
                'id' => 'tonica',
                'category' => 'Teoría',
                'title' => 'Tónica',
                'subtitle' => 'La nota casa',
                'icon' => '𝆓',
                'bg' => 'from-emerald-400 to-green-600',
                'description' => 'Es la nota principal. Cuando llegamos a ella, sentimos que todo terminó bien.',
                'fact' => 'Es el centro de gravedad de la canción.',
                'animation' => 'home'
            ],
            [
                'id' => 'dominante',
                'category' => 'Teoría',
                'title' => 'Dominante',
                'subtitle' => 'Ganas de volver',
                'icon' => '𝆒',
                'bg' => 'from-yellow-400 to-amber-500',
                'description' => 'Es una nota inquieta que suena con mucha energía y siempre quiere volver a casa (tónica).',
                'fact' => '¡Crea la tensión necesaria en la música!',
                'animation' => 'tension'
            ],

            // 6. EXPRESIÓN Y TÉCNICA
            [
                'id' => 'dinamica-p',
                'category' => 'Técnica',
                'title' => 'Piano (Dinámica)',
                'subtitle' => 'Suave susurro',
                'icon' => '𝆏',
                'bg' => 'from-blue-400 to-cyan-500',
                'description' => 'Significa tocar suave y delicado, como si no quisieras despertar a nadie.',
                'fact' => '¡Viene de la palabra italiana "piano", que significa suave!',
                'animation' => 'volume-down'
            ],
            [
                'id' => 'dinamica-f',
                'category' => 'Técnica',
                'title' => 'Forte (Dinámica)',
                'subtitle' => 'Con energía',
                'icon' => '𝆑',
                'bg' => 'from-red-500 to-orange-600',
                'description' => 'Significa tocar con fuerza y vitalidad, ¡como un rugido de alegría!',
                'fact' => 'Forte significa fuerte en italiano.',
                'animation' => 'volume-up'
            ],
            [
                'id' => 'staccato',
                'category' => 'Técnica',
                'title' => 'Staccato',
                'subtitle' => 'Saltitos cortos',
                'icon' => '𝄀 .',
                'bg' => 'from-pink-400 to-purple-500',
                'description' => 'Notas muy cortitas y separadas, ¡como si las teclas quemaran!',
                'fact' => 'Se escribe con un puntito sobre o bajo la nota.',
                'animation' => 'popcorn'
            ],
            [
                'id' => 'legato',
                'category' => 'Técnica',
                'title' => 'Legato',
                'subtitle' => 'Todo pegadito',
                'icon' => '𝆢',
                'bg' => 'from-teal-400 to-blue-500',
                'description' => 'Notas suaves y unidas, como si fluyeran como el agua.',
                'fact' => '¡Suena como si las notas se estuvieran dando la mano!',
                'animation' => 'flow'
            ],
            [
                'id' => 'pedal',
                'category' => 'Técnica',
                'title' => 'Pedal',
                'subtitle' => 'Efecto nube',
                'icon' => '𝆮',
                'bg' => 'from-slate-600 to-slate-800',
                'description' => 'Una palanca que pisas con el pie para que el sonido no pare al levantar los dedos.',
                'fact' => '¡Hace que el piano suene mágico y espacial!',
                'animation' => 'echo'
            ],
            [
                'id' => 'dedos',
                'category' => 'Técnica',
                'title' => 'Dedos (1-5)',
                'subtitle' => 'Números secretos',
                'icon' => '🖐️',
                'bg' => 'from-blue-300 to-cyan-500',
                'description' => 'Cada dedo tiene su número: el Pulgar es el 1 y el Meñique es el 5.',
                'fact' => '¡Saber los números te ayuda a tocar mucho más rápido!',
                'animation' => 'finger-tap'
            ],
            [
                'id' => 'armadura',
                'category' => 'Teoría',
                'title' => 'Armadura',
                'subtitle' => 'Reglas del juego',
                'icon' => '♯♯♯',
                'bg' => 'from-amber-600 to-orange-800',
                'description' => 'Sostenidos o bemoles al principio que nos dicen qué notas cambian en toda la canción.',
                'fact' => '¡Es como saber qué ropa llevar según el clima de la canción!',
                'animation' => 'rules'
            ],
            [
                'id' => 'repeticion',
                'category' => 'Fundamentos',
                'title' => 'Repetición',
                'subtitle' => '¡Otra vez!',
                'icon' => '𝄇',
                'bg' => 'from-green-500 to-teal-700',
                'description' => 'Dos puntos que nos mandan de vuelta a una parte anterior para tocarla de nuevo.',
                'fact' => '¡Si algo es bonito, vale la pena tocarlo dos veces!',
                'animation' => 'loop'
            ],
        ];
    }

    public function setCategory($cat)
    {
        $this->activeCategory = $cat;
    }

    public function getFilteredConceptsProperty()
    {
        if ($this->activeCategory === 'Todos') {
            return $this->concepts;
        }
        return collect($this->concepts)->where('category', $this->activeCategory)->all();
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
