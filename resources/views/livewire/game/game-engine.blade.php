<div class="min-h-screen bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 p-2 md:p-4 flex flex-col items-center justify-center">
    <div class="max-w-5xl w-full">
        <!-- Dashboard Superior del Juego -->
        <div class="flex flex-wrap justify-between items-center mb-2 bg-white/10 backdrop-blur-xl p-3 rounded-[1.5rem] border-2 border-white/20 shadow-2xl text-white">
            <div class="flex items-center gap-6">
                <a href="{{ route('game.map') }}" class="w-14 h-14 bg-white/20 hover:bg-white/40 flex items-center justify-center rounded-2xl transition-all border-b-4 border-white/20 active:border-b-0 active:translate-y-1 text-2xl">
                    🏠
                </a>
                <div>
                    <h2 class="text-3xl font-black leading-tight">Nivel {{ $level }}</h2>
                    <p class="font-bold opacity-70 tracking-wide uppercase text-xs">{{ $world === 'sol' ? 'Clave de Sol' : 'Clave de Fa' }}</p>
                </div>
            </div>

            <!-- Vidas (Corazones animadores) -->
            <div class="flex gap-3 bg-black/20 px-6 py-3 rounded-full border-2 border-white/10">
                @for($i = 1; $i <= 3; $i++)
                    <span class="text-3xl transition-all duration-500 {{ $i <= $lives ? 'scale-110 drop-shadow-[0_0_10px_rgba(255,255,255,0.5)]' : 'grayscale opacity-30 scale-90' }}">
                        ❤️
                    </span>
                @endfor
            </div>

            <!-- Progreso de la secuencia -->
            <div class="hidden md:flex gap-2">
                @foreach($notes as $index => $n)
                    <div class="w-4 h-4 rounded-full border-2 border-white/30 {{ $index < $currentIndex ? 'bg-green-400 border-green-200' : 'bg-white/10' }}"></div>
                @endforeach
            </div>
        </div>

        <!-- Área Principal: Pentagrama -->
        <div class="relative mb-4 group">
            <div class="absolute -inset-4 bg-gradient-to-r from-yellow-400 to-pink-500 rounded-[4rem] blur-2xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
            @livewire('game.staff-renderer', [
                'clef' => $world, 
                'activeNotes' => $notes,
                'showNames' => ($world === 'sol') ? ($level <= 10) : ($level <= 20),
                'interactive' => $level > 30
            ])
            
            @if($gameState === 'waiting')
                <div class="absolute inset-0 bg-black/40 backdrop-blur-sm rounded-[3rem] flex flex-col items-center justify-center animate-fade-in z-20">
                    <h3 class="text-5xl font-black text-white mb-8 text-center px-6">¿Listo para el desafío? 🎵</h3>
                    <p class="text-white/70 font-bold mb-6 italic">{{ $level > 30 ? '¡Ubica las notas en el pentagrama!' : '¡Adivina las notas!' }}</p>
                    <button wire:click="startGame" class="bg-yellow-400 hover:bg-yellow-300 text-purple-900 font-black py-8 px-20 rounded-[3rem] text-4xl shadow-[0_15px_0_rgb(202,138,4)] transition-all hover:-translate-y-2 active:translate-y-2 active:shadow-none">
                        🚀 ¡A JUGAR!
                    </button>
                </div>
            @endif
        </div>

        <!-- Instrucción para niveles interactivos (31-50) -->
        @if($gameState === 'playing' && $level > 30)
            <div class="mb-2 animate-fade-in text-center">
                <div class="bg-white/10 backdrop-blur-md border-2 border-white/20 px-6 py-2 rounded-full inline-flex items-center gap-4 shadow-xl">
                    <span class="text-white/60 font-black uppercase tracking-widest text-[10px]">Ubica la nota:</span>
                    <h2 class="text-2xl font-black text-white drop-shadow-lg leading-none">
                        {{ $names[substr($notes[$currentIndex]['pitch'], 0, 1)] }}
                    </h2>
                    <div class="w-px h-4 bg-white/20 ml-2"></div>
                    <p class="text-white/80 text-xs font-black animate-pulse flex items-center gap-1">
                        <span>👆</span> Toca el pentagrama
                    </p>
                </div>

                @if($hint)
                    <div class="mt-2 bg-yellow-400 text-purple-900 px-6 py-2 rounded-2xl font-black text-lg animate-bounce shadow-xl border-4 border-white inline-block">
                        {{ $hint }}
                    </div>
                @endif
            </div>
        @endif

        <!-- Teclado de Notas Musicales -->
        @if($gameState === 'playing')
            @php
                $inputNotesSol = ['C4', 'D4', 'E4', 'F4', 'G4', 'A4', 'B4'];
                $inputNotesFa = ['C3', 'D3', 'E3', 'F2', 'G2', 'A2', 'B2'];
                $displayNotes = $world === 'sol' ? $inputNotesSol : $inputNotesFa;
                $names = ['C' => 'Do', 'D' => 'Re', 'E' => 'Mi', 'F' => 'Fa', 'G' => 'Sol', 'A' => 'La', 'B' => 'Si'];
            @endphp
            @if($level <= 30)
                <div class="grid grid-cols-4 md:grid-cols-7 gap-3 animate-fade-in-up">
                    @foreach($displayNotes as $p)
                        <button wire:click="submitNote('{{ $p }}')" 
                            class="group bg-white hover:bg-yellow-50 p-4 rounded-3xl shadow-xl border-b-6 border-gray-200 transition-all hover:-translate-y-1 active:translate-y-1 active:border-b-0 flex items-center justify-center">
                            <span class="text-2xl md:text-3xl font-black text-purple-600 group-hover:scale-110 transition-transform">
                                {{ $names[substr($p, 0, 1)] }}
                            </span>
                        </button>
                    @endforeach
                </div>
            @else
                {{-- Instrucción inferior removida por redundancia para ahorrar espacio --}}
            @endif
        @endif

        <!-- Pantalla de Victoria -->
        @if($gameState === 'won')
            <div class="fixed inset-0 bg-purple-900/90 backdrop-blur-xl z-50 flex items-center justify-center p-4 animate-fade-in">
                <div class="bg-white rounded-[3rem] p-8 md:p-12 max-w-xl w-full text-center shadow-2xl border-b-[12px] border-purple-200">
                    <div class="text-[6rem] mb-4 animate-bounce">{{ $isLastLevel ? '🎓' : '🏆' }}</div>
                    
                    @if($isLastLevel)
                        <h2 class="text-4xl font-black text-purple-600 mb-2 leading-tight">¡MAESTRÍA COMPLETADA!</h2>
                        <p class="text-xl font-bold text-gray-500 mb-6 text-pretty">Has culminado todos los retos de la {{ $world === 'sol' ? 'Clave de Sol' : 'Clave de Fa' }}.</p>
                    @else
                        <h2 class="text-5xl font-black text-purple-600 mb-2">¡SÚPER BIEN!</h2>
                        <p class="text-xl font-bold text-gray-500 mb-6 text-pretty">¡Has dominado el Nivel {{ $level }}!</p>
                    @endif
                    
                    <div class="flex justify-center gap-3 mb-8">
                        @for($i = 1; $i <= 3; $i++)
                            <span class="text-5xl md:text-6xl {{ $i <= $stars ? 'text-yellow-400 drop-shadow-lg' : 'text-gray-200' }} animate-pulse" 
                                  style="animation-delay: {{ $i * 0.1 }}s">★</span>
                        @endfor
                    </div>

                    <div class="flex flex-col md:flex-row gap-3">
                        <button wire:click="initGame" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-black py-4 rounded-2xl text-xl transition-all border-b-4 border-gray-300">
                            Repetir 🔄
                        </button>
                        
                        @if($isLastLevel)
                            <a href="{{ route('game.map') }}" class="flex-[2] bg-gradient-to-r from-yellow-400 to-orange-500 text-white font-black py-6 rounded-2xl text-2xl shadow-xl border-b-8 border-orange-700 transition-all hover:scale-105 active:translate-y-4 active:border-b-0 flex items-center justify-center">
                                VOLVER AL MAPA 🌎
                            </a>
                        @else
                            <button wire:click="nextLevel" class="flex-[2] bg-gradient-to-r from-purple-500 to-pink-500 text-white font-black py-6 rounded-2xl text-2xl shadow-xl border-b-8 border-purple-800 transition-all hover:scale-105 active:translate-y-4 active:border-b-0">
                                ¡SIGUIENTE NIVEL! 🚀
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- Pantalla de Derrota -->
        @if($gameState === 'lost')
            <div class="fixed inset-0 bg-indigo-900/90 backdrop-blur-xl z-50 flex items-center justify-center p-4 animate-fade-in">
                <div class="bg-white rounded-[3rem] p-8 md:p-12 max-w-xl w-full text-center shadow-2xl border-b-[12px] border-indigo-200">
                    <div class="text-[6rem] mb-4">🥺</div>
                    <h2 class="text-5xl font-black text-indigo-600 mb-2">¡Casi casi!</h2>
                    <p class="text-xl font-bold text-gray-500 mb-8">¡La música se aprende practicando!</p>
                    
                    <button wire:click="retry" class="w-full bg-indigo-500 hover:bg-indigo-400 text-white font-black py-6 rounded-2xl text-2xl shadow-xl border-b-8 border-indigo-800 transition-all hover:scale-105 active:translate-y-4 active:border-b-0">
                        🔄 INTENTAR OTRA VEZ
                    </button>
                    <a href="{{ route('game.map') }}" class="inline-block mt-6 text-indigo-400 font-bold hover:text-indigo-600 text-sm">
                        Volver al mapa por ahora
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Confetti y Efectos Visuales -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
    <script>
        function playPianoNote(pitch) {
            if (!pitch) return;
            const url = `https://gleitz.github.io/midi-js-soundfonts/FluidR3_GM/acoustic_grand_piano-mp3/${pitch}.mp3`;
            const audio = new Audio(url);
            audio.play().catch(e => console.error("Error al reproducir piano:", e));
        }

        document.addEventListener('livewire:init', () => {
            Livewire.on('playSuccessSound', (event) => {
                const pitch = event.pitch || (event[0] ? event[0].pitch : null);
                playPianoNote(pitch);
            });
            Livewire.on('playErrorSound', () => console.log('❌ Error!'));
            Livewire.on('playHintSound', () => console.log('🔍 Pista...'));

            // Escuchador de Celebración Final
            Livewire.on('celebrate-victory', () => {
                const duration = 5 * 1000;
                const animationEnd = Date.now() + duration;
                const defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 100 };

                function randomInRange(min, max) {
                    return Math.random() * (max - min) + min;
                }

                const interval = setInterval(function() {
                    const timeLeft = animationEnd - Date.now();

                    if (timeLeft <= 0) {
                        return clearInterval(interval);
                    }

                    const particleCount = 50 * (timeLeft / duration);
                    confetti({ ...defaults, particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } });
                    confetti({ ...defaults, particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } });
                }, 250);
            });
        });
    </script>

    <style>
        @keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }
        @keyframes fade-in-up { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fade-in 0.4s ease-out forwards; }
        .animate-fade-in-up { animation: fade-in-up 0.5s ease-out forwards; }
    </style>
</div>
