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
                'icon' => '🎶',
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
                'icon' => '<svg viewBox="0 0 189 267" class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M 77.5 29 L 120.5 66 L 137 82.5 Q 139.6 83.9 139 88.5 L 136 95.5 L 115 119.5 L 106 132.5 L 102 142.5 L 101 153.5 L 112 172.5 L 148 212.5 L 146.5 213 Q 131.7 204.3 106.5 206 L 93.5 210 L 84 217.5 L 78 228.5 L 78 237.5 L 92 255.5 L 90.5 256 Q 68.5 246 52 230.5 L 44 217.5 L 44 203.5 Q 45.8 194.3 52.5 190 L 66.5 185 L 89.5 184 L 98 181.5 L 71 156.5 L 56 136.5 L 53 129.5 L 53 124.5 L 89 79.5 L 91 75.5 L 91 62.5 L 88 52.5 L 77 31.5 L 77.5 29 Z " /></svg>',
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
                'icon' => '<svg viewBox="0 0 600 600" class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M 363.5 45 L 378 45 L 378 52.5 Q 379.5 55.5 385.5 54 L 387 53.5 L 387 489.5 Q 381.6 521.6 359.5 537 Q 342.5 550 319.5 557 L 291.5 563 L 280.5 563 L 269.5 561 L 261.5 558 L 240 541.5 Q 228.3 530.7 228 508.5 L 229 507.5 L 230 496.5 L 236 482.5 Q 242.7 471.2 252.5 463 Q 272.5 446.5 300.5 438 L 313.5 435 L 337.5 435 Q 353 438 362.5 447 L 363 114.5 L 362 112.5 L 363 111.5 L 363 96.5 L 362 95.5 L 362 84.5 L 363 83.5 L 363 64.5 L 362 63.5 L 362 46.5 L 363.5 45 Z " /></svg>',
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
                'icon' => '<svg viewBox="0 0 400 400" class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M 283 0 L 301.5 0 L 302 0.5 L 302 302.5 L 297 314.5 L 282.5 331 L 255.5 349 L 246.5 352 L 244.5 354 L 238 355 Q 239.3 358.3 234.5 357 L 224.5 361 L 220.5 361 L 218.5 363 L 213.5 363 L 204.5 366 L 198.5 366 L 194.5 368 L 185.5 368 L 184.5 369 L 149.5 369 L 148.5 368 L 138.5 368 L 135.5 366 L 131.5 366 L 122.5 363 Q 111.5 358.5 105 349.5 L 99 337.5 L 98 317.5 L 102 304.5 L 112 290 L 131.5 275 L 160.5 261 L 175.5 257 L 178.5 255 L 182.5 255 L 200.5 250 L 217.5 249 L 218.5 248 L 229.5 248 L 230.5 247 L 241.5 247 L 242.5 248 L 260.5 249 Q 264.8 252.2 272.5 252 L 278.5 255 L 283 255 L 283 0 Z M 250 268 L 220 275 L 218 277 L 206 280 L 197 285 L 194 285 L 154 305 L 137 317 Q 125 324 121 338 L 122 344 L 127 347 L 135 349 L 146 349 L 152 347 L 164 346 L 191 338 L 229 321 Q 247 312 263 299 Q 273 292 279 280 L 279 275 L 277 271 L 269 268 L 250 268 Z " /></svg>',
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
                'icon' => $svgNote('<path d="M50 30c-20 0-35 9-35 20s15 20 35 20 35-9 35-20S70 30 50 30zm0 32c-12 0-20-5-20-12s8-12 20-12 20 5 20 12-8 12-20 12z" transform="rotate(-20 50 50)" fill="currentColor"/>'),
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
                'icon' => '<svg viewBox="0 0 231 218" class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M 116.5 2 Q 118.9 16.1 126.5 25 L 210.5 25 L 211.5 24 L 231 24 L 230.5 29 L 208.5 29 L 207.5 30 L 130 30.5 L 136 38 L 137.5 38 L 159 57.5 L 169 70.5 L 172 78 L 230.5 78 L 231 83 L 175.5 83 L 175 84.5 L 178 95.5 L 178 117.5 L 175 130.5 L 231 131 L 230.5 136 L 174.5 136 L 174 137.5 Q 169.2 153.2 161.5 166 L 161 164.5 Q 167.9 151.9 170 136 L 121 136 L 121 182.5 Q 118.8 183.7 121.5 185 L 231 184 L 230.5 189 L 141.5 189 L 140.5 190 L 118 190 L 116 195.5 L 106.5 206 L 94.5 213 L 79.5 215 L 69.5 212 L 64 206.5 Q 60.3 200.6 62 190 L 0.5 190 L 0 185 L 63.5 185 L 65 183.5 L 67 178.5 L 77.5 168 L 89.5 162 L 103.5 161 L 108.5 162 L 115.5 166 L 116 136.5 L 113.5 136 L 93.5 136 L 91.5 137 L 90.5 136 L 80.5 136 L 79.5 137 L 0 137 L 0.5 132 L 86.5 132 L 87.5 131 L 114.5 131 L 116 131.5 L 116 83 L 37.5 83 L 36.5 84 L 0 84 L 0 78.5 L 0.5 78 L 116 78 L 116 30 L 4.5 30 L 1.5 31 Q -1.3 29.6 0 25 L 115.5 25 L 116 24.5 L 116.5 2 Z M 121 54 L 121 78 L 158 78 Q 144 61 121 54 Z M 121 83 L 121 131 L 171 131 L 172 126 Q 174 100 164 86 L 162 83 L 121 83 Z " /></svg>',
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
                'icon' => '<svg viewBox="0 0 250 161" class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M 222.5 15 L 226 15.5 L 226 37.5 L 227.5 39 L 250 39 L 249.5 41 L 226 41 L 226 62 L 249.5 62 L 250 65 L 226 65 L 226 86 L 249.5 86 L 250 89 L 224.5 89 L 224 90.5 L 220.5 95 Q 215 101.5 202.5 101 L 196 96.5 L 195 90.5 L 195.5 89 L 167.5 89 L 167 89.5 L 167 97.5 Q 164.9 105.4 158.5 109 L 157 109.5 L 250 110 L 249.5 113 L 105.5 113 L 99.5 120 Q 94.1 124.6 84.5 125 Q 78.8 123.8 76 119.5 Q 76.8 113.3 75.5 113 L 50.5 113 Q 49.3 110.8 48 113.5 L 47 123.5 L 38 133.5 L 250 134 L 249.5 136 L 0 136 L 0.5 134 L 17.5 134 L 18 132.5 L 16 127.5 Q 17.4 120 22.5 116 L 27 114 L 26.5 112 L 25.5 113 L 0 113 L 0.5 110 L 45 110 L 45 89 L 0.5 89 L 0 86 L 45 86 L 45 65 L 0.5 65 L 0 62 L 45 62 L 45 41 L 0.5 41 L 0 39 L 45.5 39 L 46.5 38 L 55.5 38 L 56.5 37 L 71.5 36 L 93.5 32 L 100.5 32 L 101.5 31 L 108.5 31 L 131.5 27 L 146.5 26 L 147.5 25 L 161.5 24 L 162.5 23 L 191.5 20 L 192.5 19 L 206.5 18 L 222.5 15 Z M 220 27 L 219 28 L 183 32 L 182 33 L 175 33 L 174 34 L 167 34 L 167 39 L 200 38 L 201 37 L 222 35 L 223 34 L 223 27 L 220 27 Z M 160 35 L 152 37 L 144 37 L 141 39 L 163 39 Q 165 38 163 37 Q 164 34 160 35 Z M 114 41 L 107 44 Q 106 49 109 50 L 155 44 L 156 43 L 163 43 L 163 41 L 114 41 Z M 100 43 L 84 46 L 70 47 L 69 48 L 54 49 L 53 50 L 48 50 L 48 58 L 51 57 L 58 57 L 59 56 L 80 54 L 88 52 L 103 51 L 104 50 L 104 43 L 100 43 Z M 221 46 L 213 48 L 206 48 L 205 49 L 169 53 L 167 55 L 167 62 L 168 62 L 223 62 L 223 47 L 221 46 Z M 161 54 L 146 57 L 109 61 L 109 62 L 164 62 Q 165 62 164 56 L 161 54 Z M 79 65 L 78 66 L 48 69 L 48 86 L 49 86 L 104 86 L 104 65 L 79 65 Z M 107 65 L 107 86 L 164 86 L 164 65 L 107 65 Z M 167 65 L 167 86 L 197 86 Q 201 78 212 75 Q 220 74 223 76 L 223 66 L 223 65 L 167 65 Z M 48 89 L 48 110 L 78 110 L 78 109 Q 82 101 92 99 Q 99 98 103 100 L 104 101 L 104 90 L 104 89 L 48 89 Z M 107 89 L 107 110 L 138 110 L 136 107 L 136 102 L 139 96 L 147 90 L 107 89 Z " /></svg>',
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
                'icon' => '<svg viewBox="0 0 100 100" class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><path d="M50 10 L80 90 L20 90 Z" fill="none" stroke="currentColor" stroke-width="4"/><path d="M50 80 L50 30" stroke="currentColor" stroke-width="4" stroke-linecap="round"><animateTransform attributeName="transform" type="rotate" from="-20 50 80" to="20 50 80" dur="1s" repeatCount="indefinite" /></path></svg>',
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
                'icon' => '<svg viewBox="0 0 1020 628" class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M 182.5 0 Q 189.7 1.8 193 7.5 L 210 32.5 L 229 75.5 L 236 103.5 Q 234.2 109.7 237 111.5 L 237 134.5 L 236 135.5 L 234 154.5 L 232 158.5 L 233.5 160 L 561.5 160 L 563 158.5 L 563 102.5 L 566.5 98 Q 572.3 97.2 574 100.5 L 574 109.5 L 578 128.5 L 585 146.5 L 592.5 160 L 1018 160 L 1018 494 L 231.5 494 L 230 495.5 L 230 535.5 L 229 536.5 L 228 556.5 Q 224.3 574.8 216 588.5 L 203 606 L 192.5 614 L 180.5 620 L 166.5 623 L 155.5 623 L 139.5 620 L 125.5 614 Q 113.6 606.9 105 596.5 Q 91 582 92 552.5 Q 94.9 538.9 104.5 532 L 120.5 524 L 135.5 524 Q 147.8 527.7 154 537.5 L 158 545.5 L 160 559.5 L 158 568.5 L 149.5 581 Q 141.5 589 125.5 589 L 120.5 587 L 120 588.5 L 126.5 596 L 143.5 606 L 150.5 608 L 164.5 609 L 175.5 607 L 182.5 604 L 199 589.5 L 210 569.5 L 213 559.5 L 215 548.5 L 215 537.5 L 216 536.5 L 217 499.5 L 216 494 L 3.5 494 L 3 493.5 L 3 487 L 148 486.5 Q 125.1 475.9 109 458.5 L 94 439.5 L 81.5 412 L 3.5 412 L 3 411.5 L 3 405 L 79.5 405 Q 80.5 405 80 400.5 L 78 392.5 L 78 365.5 L 83 339.5 L 86 331.5 L 4.5 331 L 3 329.5 Q 2.3 323.3 3.5 323 L 88.5 323 L 93 316.5 L 105 291.5 L 136 249.5 L 3 249 L 3 242.5 L 4.5 241 L 142.5 241 L 144 239.5 L 155 224.5 L 155 222.5 L 150 209.5 L 141 176.5 L 140 168.5 L 138.5 167 L 3.5 167 L 3 166.5 L 3 160 L 136.5 160 L 138 158.5 L 137 157.5 L 137 151.5 L 135 143.5 L 135 134.5 L 134 133.5 L 133 99.5 L 134 98.5 L 134 87.5 L 135 86.5 L 136 75.5 L 144 49.5 Q 155.2 24.2 173.5 6 L 182.5 0 Z M 200 48 L 189 56 Q 173 69 163 87 L 153 111 L 149 133 L 149 145 L 150 146 L 151 159 L 153 160 L 198 160 L 206 143 L 211 126 L 212 115 L 213 114 L 213 101 L 214 100 L 213 80 L 211 70 L 201 50 Q 202 47 200 48 Z M 153 167 L 161 200 L 166 210 Q 182 191 194 169 L 194 167 L 153 167 Z M 231 167 Q 213 209 186 241 L 563 241 L 563 168 L 563 167 L 231 167 Z M 597 167 L 599 173 L 624 212 L 636 240 L 638 241 L 1005 241 L 1005 168 L 1005 167 L 597 167 Z M 575 182 L 574 241 L 620 241 L 602 212 L 575 182 Z M 179 249 L 179 254 L 201 322 L 202 323 L 563 323 L 563 250 L 563 249 L 179 249 Z M 574 249 L 574 323 L 620 323 L 621 322 L 625 308 L 628 292 L 628 282 L 629 281 Q 630 262 624 252 L 624 249 L 574 249 Z M 640 249 L 642 260 L 642 272 L 643 273 L 641 300 L 635 323 L 1005 323 L 1005 250 L 1005 249 L 640 249 Z M 168 265 Q 145 292 126 323 L 186 323 L 169 268 Q 170 264 168 265 Z M 122 331 Q 113 345 107 362 L 103 379 L 102 394 L 101 395 L 101 405 L 132 405 L 131 400 L 131 379 L 134 367 Q 139 353 148 344 L 164 332 L 122 331 Z M 240 331 L 240 332 Q 250 336 257 343 Q 270 355 278 372 L 284 389 L 286 405 L 475 405 Q 468 399 466 389 L 466 379 L 468 370 L 479 352 Q 490 339 505 332 L 240 331 Z M 574 331 L 574 357 Q 572 358 573 363 Q 569 375 562 384 Q 551 396 537 405 L 1005 405 L 1005 332 L 1005 331 L 632 331 L 629 342 L 626 345 Q 617 346 615 341 Q 614 334 617 332 L 574 331 Z M 191 358 L 179 361 L 168 367 Q 156 375 152 391 L 152 405 L 153 405 L 206 405 L 200 373 L 196 360 Q 197 357 191 358 Z M 211 359 L 220 404 L 222 405 L 262 405 L 261 399 L 252 383 Q 239 363 211 359 Z M 104 412 L 102 414 Q 102 423 106 430 L 119 449 Q 132 462 150 471 L 166 477 L 181 480 L 206 480 Q 207 477 214 479 L 216 478 L 215 477 L 215 465 L 214 464 L 212 439 L 211 438 L 208 414 L 207 412 L 155 412 L 159 422 Q 168 433 182 439 Q 184 441 183 447 L 178 451 L 170 449 L 152 437 Q 141 428 136 415 L 134 412 L 104 412 Z M 222 412 L 226 437 L 227 452 L 228 453 L 229 474 Q 238 472 245 466 L 258 450 L 263 438 L 264 427 L 265 426 L 265 417 L 264 416 L 264 412 L 222 412 Z M 286 412 L 285 426 L 281 440 Q 276 452 268 462 Q 257 476 240 485 Q 236 484 237 487 L 1004 487 L 1005 486 L 1005 414 L 1004 412 L 517 412 L 516 413 L 491 413 L 490 412 L 286 412 Z "/></svg>',
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
                'icon' => $svgNote('<text x="25" y="80" font-family="Arial" font-style="italic" font-weight="900" font-size="70" fill="currentColor">8</text><text x="65" y="45" font-family="Arial" font-style="italic" font-weight="900" font-size="30" fill="currentColor">va</text>'),
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
                'icon' => $svgNote('
                    <!-- Sol Radiante -->
                    <circle cx="20" cy="85" r="10" fill="#FBBF24" />
                    <g stroke="#FBBF24" stroke-width="2" stroke-linecap="round">
                        <line x1="20" y1="70" x2="20" y2="65" /><line x1="20" y1="100" x2="20" y2="105" />
                        <line x1="5" y1="85" x2="0" y2="85" /><line x1="35" y1="85" x2="40" y2="85" />
                        <line x1="10" y1="75" x2="7" y2="72" /><line x1="30" y1="75" x2="33" y2="72" />
                    </g>
                    <path d="M16 87 q4 3 8 0" stroke="#B45309" fill="none" stroke-width="1.5" />

                    <!-- Corchea Dorada Mejorada (Estructura Corchea) -->
                    <g transform="translate(10, 0)">
                        <ellipse cx="35" cy="75" rx="18" ry="13" transform="rotate(-20 35 75)" fill="#FCD34D" stroke="#F59E0B" stroke-width="2" />
                        <path d="M53 75 Q 55 40, 75 25" stroke="#F59E0B" stroke-width="7" fill="none" stroke-linecap="round" />
                        <path d="M75 25 c 12 5 22 18 15 40" stroke="#D97706" stroke-width="6" fill="none" stroke-linecap="round" />
                    </g>

                    <!-- Partículas de Luz -->
                    <circle cx="45" cy="55" r="2" fill="white" />
                    <circle cx="65" cy="35" r="1.5" fill="white" />
                    <path d="M85 15 L87 18 L90 15 L87 12 Z" fill="white" />
                    <path d="M30 45 L32 48 L35 45 L32 42 Z" fill="white" />
                '),
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
                'icon' => $svgNote('
                    <!-- Nubarrón Sombrío -->
                    <g transform="translate(25, 10)">
                        <path d="M0 10 q0 -8 8 -8 q8 0 8 4 q4 -4 8 0 q8 0 8 8 z" fill="#4B5563" />
                        <path d="M5 12 q0 -6 6 -6 q6 0 6 3 q3 -3 6 0 q6 0 6 6 z" fill="#374151" transform="translate(10, 2)" />
                    </g>
                    
                    <!-- Lágrimas / Gotas -->
                    <circle cx="45" cy="40" r="1.5" fill="#60A5FA" opacity="0.6" />
                    <circle cx="60" cy="45" r="1.5" fill="#60A5FA" opacity="0.6" />
                    <circle cx="35" cy="50" r="1.5" fill="#60A5FA" opacity="0.6" />

                    <!-- Corchea Melancólica (Estructura Descendente) -->
                    <g transform="translate(0, 5)">
                        <ellipse cx="60" cy="30" rx="17" ry="12" transform="rotate(25 60 30)" fill="#1F2937" stroke="#111827" stroke-width="2" />
                        <path d="M43 30 Q 40 60, 43 90" stroke="#111827" stroke-width="7" fill="none" stroke-linecap="round" />
                        <path d="M43 90 Q 55 105, 50 125" stroke="#374151" stroke-width="6" fill="none" stroke-linecap="round" />
                    </g>
                '),
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
                'icon' => $svgNote('
                    <!-- Resplandor de Fusión -->
                    <defs>
                        <radialGradient id="chordGlow" cx="50%" cy="50%" r="50%">
                            <stop offset="0%" stop-color="#93C5FD" stop-opacity="0.6" />
                            <stop offset="100%" stop-color="#93C5FD" stop-opacity="0" />
                        </radialGradient>
                    </defs>
                    <circle cx="42" cy="55" r="30" fill="url(#chordGlow)" />

                    <!-- Notas Apiladas (Azules Graduados) -->
                    <g stroke-linecap="round">
                        <!-- Nota 1 (Base - Azul Oscuro) -->
                        <ellipse cx="40" cy="75" rx="15" ry="11" transform="rotate(-20 40 75)" fill="#1E3A8A" />
                        <path d="M53 75V25" stroke="#1E3A8A" stroke-width="4" />
                        
                        <!-- Nota 2 (Azul Medio) -->
                        <ellipse cx="40" cy="62" rx="15" ry="11" transform="rotate(-20 40 62)" fill="#2563EB" />
                        <path d="M53 62V20" stroke="#2563EB" stroke-width="4" />
                        
                        <!-- Nota 3 (Azul Claro) -->
                        <ellipse cx="40" cy="49" rx="15" ry="11" transform="rotate(-20 40 49)" fill="#3B82F6" />
                        <path d="M53 49V15" stroke="#3B82F6" stroke-width="4" />
                        
                        <!-- Nota 4 (Azul Celeste) -->
                        <ellipse cx="40" cy="36" rx="15" ry="11" transform="rotate(-20 40 36)" fill="#60A5FA" />
                        <path d="M53 36V10" stroke="#60A5FA" stroke-width="4" />
                    </g>

                    <!-- Hilos Entrelazados (Colas) -->
                    <path d="M53 10 C 80 20, 80 50, 53 60 S 80 90, 53 100" stroke="#1E40AF" stroke-width="3" fill="none" opacity="0.7" />
                    <path d="M53 20 C 75 30, 75 55, 53 65 S 75 85, 53 95" stroke="#3B82F6" stroke-width="2" fill="none" opacity="0.5" />
                '),
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
                'icon' => $svgNote('
                    <g fill="currentColor">
                        <!-- Raíz (Abajo) -->
                        <g transform="translate(50, 85) scale(0.35) translate(-35, -75)">
                            <ellipse cx="35" cy="75" rx="18" ry="13" transform="rotate(-20 35 75)"/>
                            <path d="M53 75V25" stroke="currentColor" stroke-width="8"/>
                            <path d="M53 25c15 5 25 20 20 40" stroke="currentColor" stroke-width="8" fill="none"/>
                        </g>
                        <!-- Tercera (Arriba Izquierda) -->
                        <g transform="translate(30, 45) scale(0.35) translate(-35, -75)">
                            <ellipse cx="35" cy="75" rx="18" ry="13" transform="rotate(-20 35 75)"/>
                            <path d="M53 75V25" stroke="currentColor" stroke-width="8"/>
                            <path d="M53 25c15 5 25 20 20 40" stroke="currentColor" stroke-width="8" fill="none"/>
                        </g>
                        <!-- Quinta (Arriba Derecha) -->
                        <g transform="translate(70, 45) scale(0.35) translate(-35, -75)">
                            <ellipse cx="35" cy="75" rx="18" ry="13" transform="rotate(-20 35 75)"/>
                            <path d="M53 75V25" stroke="currentColor" stroke-width="8"/>
                            <path d="M53 25c15 5 25 20 20 40" stroke="currentColor" stroke-width="8" fill="none"/>
                        </g>
                    </g>
                '),
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
                'icon' => $svgNote('
                    <!-- Ondas de Resolución -->
                    <circle cx="50" cy="50" r="40" fill="none" stroke="#10B981" stroke-width="1" opacity="0.2" />
                    <circle cx="50" cy="50" r="30" fill="none" stroke="#10B981" stroke-width="1" opacity="0.4" />
                    <circle cx="50" cy="50" r="20" fill="none" stroke="#10B981" stroke-width="1" opacity="0.6" />
                    
                    <!-- Nota Redonda Estable (Tónica) -->
                    <ellipse cx="50" cy="50" rx="18" ry="14" fill="#065F46" stroke="#059669" stroke-width="3" />
                    
                    <!-- Centro Dorado (Grado I) -->
                    <circle cx="50" cy="50" r="5" fill="#FBBF24" shadow="0 0 10px #FBBF24" />
                '),
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
                'icon' => $svgNote('
                    <!-- Energía / Chispas -->
                    <g fill="#FBBF24">
                        <circle cx="25" cy="65" r="2" /><circle cx="35" cy="55" r="1.5" />
                        <circle cx="50" cy="85" r="2" /><path d="M70 75 L73 78 L76 75 L73 72 Z" />
                    </g>
                    
                    <!-- Corchea Dominante (Naranja Intenso) -->
                    <g>
                        <ellipse cx="40" cy="75" rx="18" ry="13" transform="rotate(-20 40 75)" fill="#F97316" stroke="#C2410C" stroke-width="2" />
                        <path d="M58 75V25" stroke="#F97316" stroke-width="7" stroke-linecap="round" />
                        <!-- Cola apuntando a resolución -->
                        <path d="M58 25 C 75 25, 95 40, 95 65" stroke="#F97316" stroke-width="6" fill="none" stroke-linecap="round" />
                    </g>

                    <!-- Rayo de Tensión (Sensible/Séptima) -->
                    <path d="M30 40 L50 60 L40 70 L60 90" stroke="#60A5FA" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M30 40 L50 60 L40 70 L60 90" stroke="white" stroke-width="1.5" fill="none" opacity="0.5" />
                '),
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
                'icon' => $svgNote('
                    <!-- Plumas Flotantes -->
                    <g fill="#93C5FD" opacity="0.6">
                        <path d="M20 30 c 15 -10, 20 10, 5 15 s -20 -10, -5 -15" transform="rotate(-30 20 30)" />
                        <path d="M75 25 c 10 -5, 12 8, 3 12 s -12 -5, -3 -12" transform="rotate(20 75 25) scale(0.6)" />
                        <path d="M15 75 c 12 -8, 15 10, 2 15 s -18 -8, -2 -15" transform="rotate(-10 15 75) scale(0.8)" />
                    </g>

                    <!-- Corchea Etérea (Piano) -->
                    <g>
                        <!-- Cabeza Difuminada -->
                        <defs>
                            <radialGradient id="softGlow" cx="50%" cy="50%" r="50%">
                                <stop offset="0%" stop-color="#E5E7EB" stop-opacity="1" />
                                <stop offset="100%" stop-color="#E5E7EB" stop-opacity="0.4" />
                            </radialGradient>
                        </defs>
                        <ellipse cx="45" cy="75" rx="16" ry="12" transform="rotate(-20 45 75)" fill="url(#softGlow)" stroke="#BFDBFE" stroke-width="1.5" />
                        
                        <!-- Plica y Cola en ondas -->
                        <path d="M60 75 V35" stroke="#94A3B8" stroke-width="5" stroke-linecap="round" opacity="0.8" />
                        <path d="M60 35 C 75 35, 85 45, 80 60 S 90 75, 75 85" stroke="#BFDBFE" stroke-width="4" fill="none" stroke-linecap="round" opacity="0.7" />
                    </g>
                '),
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
                'icon' => $svgNote('
                    <!-- Ondas de Choque Agresivas -->
                    <g fill="none" stroke="#EF4444" stroke-width="2">
                        <circle cx="45" cy="70" r="25" opacity="0.3" />
                        <circle cx="45" cy="70" r="35" opacity="0.2" />
                        <path d="M10 70 L25 70 M65 70 L85 70 M45 35 L45 50 M45 85 L45 100" stroke-width="4" opacity="0.5" />
                    </g>
                    
                    <!-- Rayos Afilados -->
                    <g fill="#F59E0B">
                        <path d="M45 70 L35 45 L45 55 L55 45 Z" />
                        <path d="M45 70 L75 60 L65 70 L75 80 Z" />
                        <path d="M45 70 L15 80 L25 70 L15 60 Z" />
                    </g>

                    <!-- Corchea Robusta (Forte) -->
                    <g>
                        <ellipse cx="45" cy="70" rx="20" ry="15" transform="rotate(-20 45 70)" fill="#DC2626" stroke="black" stroke-width="4" />
                        <path d="M63 70 V15" stroke="black" stroke-width="10" stroke-linecap="square" />
                        <path d="M63 15 L95 15" stroke="#DC2626" stroke-width="12" stroke-linecap="square" />
                    </g>
                '),
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
                'icon' => $svgNote('
                    <!-- Efectos de Rebote (Detaché) -->
                    <g fill="none" stroke="currentColor" stroke-width="2" opacity="0.6">
                        <path d="M20 80 q 5 -10 15 0" /><path d="M70 80 q 5 -10 15 0" />
                        <path d="M45 95 q 5 -8 10 0" />
                    </g>
                    
                    <!-- Corchea Compacta (Staccato) -->
                    <g fill="currentColor">
                        <ellipse cx="50" cy="70" rx="15" ry="11" transform="rotate(-20 50 70)" />
                        <!-- Plica Truncada -->
                        <path d="M63 70 V45" stroke="currentColor" stroke-width="6" stroke-linecap="butt" />
                        <!-- Cola Corta y Seca -->
                        <path d="M63 45 L80 50" stroke="currentColor" stroke-width="5" stroke-linecap="round" />
                        
                        <!-- Puntos Staccato (Saltitos) -->
                        <circle cx="40" cy="90" r="3" />
                        <circle cx="50" cy="95" r="3" />
                        <circle cx="60" cy="90" r="3" />
                    </g>
                '),
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
                'icon' => $svgNote('
                    <!-- Ligadura de Expresión (Slur) -->
                    <path d="M25 45 C 40 25, 60 25, 75 45" stroke="#3B82F6" stroke-width="4" fill="none" stroke-linecap="round" />
                    
                    <!-- Dos Notas Unidas (Legato) -->
                    <g fill="#3B82F6">
                        <!-- Nota 1 -->
                        <ellipse cx="30" cy="70" rx="14" ry="10" transform="rotate(-20 30 70)" />
                        <path d="M42 70 V35" stroke="#3B82F6" stroke-width="5" />
                        
                        <!-- Arco de Unión Elegante -->
                        <path d="M42 35 Q 55 35, 68 70" stroke="#3B82F6" stroke-width="4" fill="none" stroke-linecap="round" />
                        
                        <!-- Nota 2 -->
                        <ellipse cx="70" cy="70" rx="14" ry="10" transform="rotate(-20 70 70)" />
                        <path d="M82 70 V35" stroke="#3B82F6" stroke-width="5" />
                    </g>
                    
                    <!-- Ondas de Fluidez -->
                    <path d="M15 85 Q 50 75, 85 85" stroke="#93C5FD" stroke-width="2" fill="none" opacity="0.5" />
                '),
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
                'icon' => $svgNote('
                    <!-- Base del Pedal -->
                    <rect x="15" y="70" width="40" height="15" rx="4" fill="currentColor" />
                    
                    <!-- Palanca Pivotante -->
                    <path d="M50 75 Q 85 75, 90 45" stroke="currentColor" stroke-width="8" fill="none" stroke-linecap="round" />
                    
                    <!-- Ondas de Sustain (Prolongación) -->
                    <g stroke="currentColor" stroke-width="2" opacity="0.5">
                        <line x1="60" y1="55" x2="95" y2="55" stroke-dasharray="4 2" />
                        <line x1="58" y1="65" x2="90" y2="65" stroke-dasharray="4 2" />
                        <line x1="55" y1="75" x2="85" y2="75" stroke-dasharray="4 2" />
                    </g>
                    
                    <!-- Asterisco de Liberación (*) -->
                    <text x="85" y="40" font-family="serif" font-weight="900" font-size="30" fill="currentColor" opacity="0.8">*</text>
                '),
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
