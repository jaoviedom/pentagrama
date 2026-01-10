<div class="min-h-screen bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 p-4 md:p-8 flex flex-col items-center justify-center">
    <div class="max-w-5xl w-full">
        <!-- Dashboard Superior del Juego -->
        <div class="flex flex-wrap justify-between items-center mb-8 bg-white/10 backdrop-blur-xl p-6 rounded-[2.5rem] border-4 border-white/20 shadow-2xl text-white">
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
        <div class="relative mb-10 group">
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
            <div class="mb-10 animate-fade-in text-center">
                <div class="bg-white/20 backdrop-blur-md border-4 border-white/30 p-8 rounded-[3rem] inline-block shadow-2xl">
                    <p class="text-white/60 font-black uppercase tracking-widest text-sm mb-2">Debes ubicar la nota:</p>
                    <h2 class="text-7xl font-black text-white drop-shadow-lg">
                        {{ $names[substr($notes[$currentIndex]['pitch'], 0, 1)] }}
                    </h2>
                </div>

                @if($hint)
                    <div class="mt-4 bg-yellow-400 text-purple-900 px-6 py-3 rounded-2xl font-black text-xl animate-bounce shadow-xl border-4 border-white inline-block">
                        {{ $hint }}
                    </div>
                @endif
            </div>
        @endif

        <!-- Teclado de Notas Musicales -->
        @if($gameState === 'playing')
            @if($level <= 30)
                <div class="grid grid-cols-4 md:grid-cols-7 gap-4 animate-fade-in-up">
                    @php
                        $inputNotesSol = ['C4', 'D4', 'E4', 'F4', 'G4', 'A4', 'B4'];
                        $inputNotesFa = ['C3', 'D3', 'E3', 'F2', 'G2', 'A2', 'B2'];
                        $displayNotes = $world === 'sol' ? $inputNotesSol : $inputNotesFa;
                        
                        $names = ['C' => 'Do', 'D' => 'Re', 'E' => 'Mi', 'F' => 'Fa', 'G' => 'Sol', 'A' => 'La', 'B' => 'Si'];
                    @endphp

                    @foreach($displayNotes as $p)
                        <button wire:click="submitNote('{{ $p }}')" 
                            class="group bg-white hover:bg-yellow-50 p-8 rounded-[2.5rem] shadow-xl border-b-8 border-gray-200 transition-all hover:-translate-y-2 active:translate-y-2 active:border-b-0 flex items-center justify-center">
                            <span class="text-4xl md:text-5xl font-black text-purple-600 group-hover:scale-110 transition-transform">
                                {{ $names[substr($p, 0, 1)] }}
                            </span>
                        </button>
                    @endforeach
                </div>
            @else
                <div class="text-center animate-pulse">
                    <p class="text-3xl font-black text-white/80">
                        👆 Toca la <span class="text-yellow-300 underline">línea o espacio</span> correcto en el pentagrama
                    </p>
                </div>
            @endif
        @endif

        <!-- Pantalla de Victoria -->
        @if($gameState === 'won')
            <div class="fixed inset-0 bg-purple-900/90 backdrop-blur-xl z-50 flex items-center justify-center p-6 animate-fade-in">
                <div class="bg-white rounded-[4rem] p-10 md:p-16 max-w-2xl w-full text-center shadow-2xl border-b-[16px] border-purple-200">
                    <div class="text-[8rem] mb-6 animate-bounce">🏆</div>
                    <h2 class="text-6xl font-black text-purple-600 mb-4">¡SÚPER BIEN!</h2>
                    <p class="text-2xl font-bold text-gray-500 mb-10 text-pretty">¡Has dominado el Nivel {{ $level }} como un Mozart!</p>
                    
                    <div class="flex justify-center gap-4 mb-12">
                        @for($i = 1; $i <= 3; $i++)
                            <span class="text-6xl md:text-8xl {{ $i <= $stars ? 'text-yellow-400 drop-shadow-lg' : 'text-gray-200' }} animate-pulse" 
                                  style="animation-delay: {{ $i * 0.1 }}s">★</span>
                        @endfor
                    </div>

                    <div class="flex flex-col md:flex-row gap-4">
                        <button wire:click="initGame" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-black py-6 rounded-3xl text-2xl transition-all border-b-4 border-gray-300">
                            Repetir 🔄
                        </button>
                        <button wire:click="nextLevel" class="flex-[2] bg-gradient-to-r from-purple-500 to-pink-500 text-white font-black py-8 rounded-3xl text-3xl shadow-xl border-b-8 border-purple-800 transition-all hover:scale-105 active:translate-y-4 active:border-b-0">
                            ¡SIGUIENTE NIVEL! 🚀
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Pantalla de Derrota -->
        @if($gameState === 'lost')
            <div class="fixed inset-0 bg-indigo-900/90 backdrop-blur-xl z-50 flex items-center justify-center p-6 animate-fade-in">
                <div class="bg-white rounded-[4rem] p-10 md:p-16 max-w-2xl w-full text-center shadow-2xl border-b-[16px] border-indigo-200">
                    <div class="text-[8rem] mb-6">🥺</div>
                    <h2 class="text-6xl font-black text-indigo-600 mb-4">¡Casi casi!</h2>
                    <p class="text-2xl font-bold text-gray-500 mb-12">No te preocupes, ¡la música se aprende practicando!</p>
                    
                    <button wire:click="retry" class="w-full bg-indigo-500 hover:bg-indigo-400 text-white font-black py-8 rounded-3xl text-3xl shadow-xl border-b-8 border-indigo-800 transition-all hover:scale-105 active:translate-y-4 active:border-b-0">
                        🔄 INTENTAR OTRA VEZ
                    </button>
                    <a href="{{ route('game.map') }}" class="inline-block mt-8 text-indigo-400 font-bold hover:text-indigo-600">
                        Volver al mapa por ahora
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Sonidos de Piano Real (Samples) -->
    <script>
        function playPianoNote(pitch) {
            if (!pitch) return;
            
            // Usamos muestras reales de un piano de cola acústico
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
        });
    </script>

    <style>
        @keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }
        @keyframes fade-in-up { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fade-in 0.4s ease-out forwards; }
        .animate-fade-in-up { animation: fade-in-up 0.5s ease-out forwards; }
    </style>
</div>
