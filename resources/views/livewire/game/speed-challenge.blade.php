<div class="min-h-screen bg-gradient-to-br from-blue-500 via-indigo-600 to-purple-700 p-4 md:p-8 flex flex-col items-center justify-center"
     wire:poll.1s="tick">
    
    <div class="max-w-4xl w-full">
        <!-- Header del Reto -->
        <div class="flex justify-between items-center bg-white/10 backdrop-blur-md rounded-[2.5rem] p-6 mb-8 border-4 border-white/20 shadow-2xl">
            <div class="flex items-center gap-6">
                <!-- Home -->
                <a href="{{ route('game.map') }}" 
                   class="flex items-center justify-center w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-2xl font-black transition-all border-b-4 border-pink-700 hover:scale-105 active:border-b-0 active:translate-y-1 shadow-xl text-3xl">
                    🗺️
                </a>
                <!-- Tiempo -->
                <div class="bg-red-500 text-white px-6 py-3 rounded-2xl flex flex-col items-center shadow-lg border-b-4 border-red-700">
                    <span class="text-xs font-black uppercase tracking-tighter opacity-80">Tiempo</span>
                    <span class="text-4xl font-black tabular-nums">{{ $timeLeft }}s</span>
                </div>
                <!-- Puntos -->
                <div class="bg-yellow-400 text-purple-900 px-6 py-3 rounded-2xl flex flex-col items-center shadow-lg border-b-4 border-yellow-600">
                    <span class="text-xs font-black uppercase tracking-tighter opacity-80">Puntos</span>
                    <span class="text-4xl font-black tabular-nums">{{ $score }}</span>
                </div>
            </div>

            <!-- Multiplicador y Combo -->
            <div class="flex items-center gap-4">
                @if($combo > 1)
                <div class="bg-green-400 text-white px-4 py-2 rounded-xl font-black animate-bounce shadow-lg">
                    COMBO x{{ $combo }}
                </div>
                @endif
                <div class="bg-gradient-to-r from-purple-400 to-pink-500 text-white px-8 py-3 rounded-2xl flex flex-col items-center shadow-lg border-b-4 border-purple-700">
                    <span class="text-xs font-black uppercase tracking-tighter opacity-80">Multiplicador</span>
                    <span class="text-4xl font-black">X{{ $multiplier }}</span>
                </div>
            </div>
        </div>

        <!-- Área Principal -->
        <div class="relative mb-10 group min-h-[300px] flex items-center justify-center">
            @if($gameState === 'playing')
                <div class="w-full">
                    @livewire('game.staff-renderer', [
                        'clef' => $world, 
                        'activeNotes' => $activeNotes,
                        'showNames' => false,
                        'interactive' => false
                    ], key('staff-'.$world.'-'.$totalHits))
                </div>
            @elseif($gameState === 'waiting')
                <div class="bg-white/20 backdrop-blur-xl rounded-[4rem] p-12 text-center border-4 border-white/30 shadow-2xl animate-fade-in">
                    <div class="text-[8rem] mb-6 animate-pulse">⚡</div>
                    <h2 class="text-5xl font-black text-white mb-2 uppercase">Reto de Velocidad</h2>
                    
                    @if($highScore > 0)
                        <div class="inline-block bg-white/10 rounded-2xl px-6 py-2 border border-white/20 mb-8">
                            <span class="text-white/60 font-black text-sm uppercase tracking-widest">Récord a vencer:</span>
                            <span class="text-yellow-300 font-black text-2xl ml-2 tabular-nums">{{ $highScore }} Pts</span>
                        </div>
                    @endif

                    <p class="text-xl font-bold text-white/70 mb-10 italic">¿Cuántas notas puedes identificar en 60 segundos?</p>
                    <button wire:click="startGame" 
                            class="bg-yellow-400 hover:bg-yellow-300 text-purple-900 font-black py-8 px-24 rounded-[3rem] text-4xl shadow-[0_15px_0_rgb(202,138,4)] transition-all hover:-translate-y-2 active:translate-y-2 active:shadow-none">
                        🔥 ¡EMPEZAR YA!
                    </button>
                </div>
            @elseif($gameState === 'finished')
                <div class="bg-white rounded-[4rem] p-12 text-center shadow-2xl animate-bounce-in border-b-[16px] border-purple-200">
                    <div class="text-[8rem] mb-6">🏁</div>
                    <h2 class="text-6xl font-black text-purple-600 mb-2 uppercase">¡TIEMPO AGOTADO!</h2>
                    <div class="flex justify-center gap-8 my-10">
                        <div class="bg-purple-100 p-8 rounded-[3rem] text-center min-w-[180px]">
                            <span class="block text-gray-500 font-bold uppercase text-sm">Puntos Finales</span>
                            <span class="text-6xl font-black text-purple-700">{{ $score }}</span>
                        </div>
                        <div class="bg-yellow-100 p-8 rounded-[3rem] text-center min-w-[180px]">
                            <span class="block text-amber-600 font-bold uppercase text-sm">Mejor Combo</span>
                            <span class="text-6xl font-black text-amber-600">{{ $maxCombo }}</span>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <button wire:click="startGame" class="flex-1 bg-purple-600 text-white font-black py-6 rounded-3xl text-2xl shadow-xl hover:bg-purple-500 transition-all">
                            🔄 REINTENTAR
                        </button>
                        <a href="{{ route('game.map') }}" class="flex-1 bg-gray-200 text-gray-600 font-black py-6 rounded-3xl text-2xl shadow-xl hover:bg-gray-300 transition-all">
                            🗺️ IR AL MAPA
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Teclado de Entrada -->
        @if($gameState === 'playing')
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
        @endif
    </div>

    <!-- Sonidos -->
    <script>
        document.addEventListener('livewire:initialized', () => {
            const success = new Audio('https://assets.mixkit.co/active_storage/sfx/2000/2000.wav');
            const error = new Audio('https://assets.mixkit.co/active_storage/sfx/2003/2003.wav');
            
            @this.on('playSuccessSound', () => { 
                success.currentTime = 0;
                success.play().catch(e => console.log('Audio error:', e)); 
            });
            @this.on('playErrorSound', () => { 
                error.currentTime = 0;
                error.play().catch(e => console.log('Audio error:', e)); 
            });
        });
    </script>
</div>
