<div class="min-h-screen bg-slate-50 p-4 md:p-8 flex flex-col items-center">
    <div class="max-w-4xl w-full">
        <!-- Dashboard Header -->
        <div class="flex justify-between items-center bg-white rounded-3xl p-6 shadow-xl mb-8 border-b-8 border-blue-100">
            <div class="flex items-center gap-4">
                <a href="{{ route('game.map') }}" 
                   class="flex items-center justify-center w-14 h-14 bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-2xl font-black transition-all border-b-4 border-indigo-700 hover:scale-105 active:border-b-0 active:translate-y-1 shadow-lg text-2xl">
                    🗺️
                </a>
                <div>
                    <h2 class="text-2xl font-black text-slate-800">Desafío Musical</h2>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-tighter">Entrenamiento Diario</p>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <div class="text-right">
                    <p class="text-xs font-black text-slate-400 uppercase">Puntos</p>
                    <p class="text-3xl font-black text-blue-500">{{ $score }} / {{ $attempts }}</p>
                </div>
                <div class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center text-white text-3xl shadow-lg border-b-4 border-blue-700">
                    ⭐
                </div>
            </div>
        </div>

        @if(!$isGameOver)
            <!-- Game Zone -->
            <div class="space-y-8 animate-fade-in">
                <!-- Question Card -->
                <div class="bg-white rounded-[3rem] p-8 shadow-2xl border-4 border-blue-50 text-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-2 bg-slate-100">
                        <div class="h-full bg-blue-500 transition-all duration-500" style="width: {{ ($attempts / $maxAttempts) * 100 }}%"></div>
                    </div>
                    
                    <h3 class="text-3xl font-black text-slate-700 mb-8">{{ $currentChallenge['question'] }}</h3>
                    
                    <!-- Staff Integration -->
                    <div class="mb-10 transform hover:scale-[1.02] transition-transform">
                        @livewire('game.staff-renderer', [
                            'clef' => $world, 
                            'activeNotes' => $currentChallenge['notes'],
                            'showNames' => false,
                        ])
                    </div>

                    <!-- Feedback Overlay -->
                    @if($feedback)
                        <div class="mb-8 p-6 rounded-3xl animate-bounce {{ $feedback['type'] === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} font-black text-xl">
                            {{ $feedback['message'] }}
                        </div>
                    @endif

                    <!-- Interaction Zone -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($currentChallenge['options'] as $option)
                            <button wire:click="checkAnswer('{{ $option }}')" 
                                {{ $feedback ? 'disabled' : '' }}
                                class="bg-slate-50 hover:bg-blue-500 hover:text-white p-6 rounded-[2rem] text-2xl font-black text-slate-600 transition-all transform hover:-translate-y-2 active:translate-y-1 border-b-8 border-slate-200 hover:border-blue-700 disabled:opacity-50 disabled:transform-none flex items-center justify-center">
                                {{ $option }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <!-- Game Over Screen -->
            <div class="bg-white rounded-[4rem] p-12 shadow-2xl text-center animate-appear border-b-[16px] border-blue-100">
                <div class="text-9xl mb-8">🎖️</div>
                <h2 class="text-6xl font-black text-slate-800 mb-4">¡Reto Terminado!</h2>
                <p class="text-2xl font-bold text-slate-400 mb-12">Has conseguido una puntuación de <span class="text-blue-500 text-4xl">{{ $score }}</span> estrellas místicas.</p>
                
                <div class="flex flex-col md:flex-row gap-6 justify-center">
                    <button wire:click="resetGame" class="bg-blue-500 hover:bg-blue-600 text-white font-black py-8 px-12 rounded-3xl text-3xl shadow-xl border-b-8 border-blue-800 transition-all hover:scale-105">
                        Jugar de nuevo 🔄
                    </button>
                    <a href="{{ route('game.map') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-black py-8 px-12 rounded-3xl text-3xl border-b-8 border-slate-300 transition-all">
                        Ir al Mapa 🗺️
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Background Decoration -->
    <div class="fixed bottom-0 left-0 w-full h-32 bg-gradient-to-t from-blue-50 to-transparent -z-10"></div>
    <div class="fixed top-1/4 -left-20 w-64 h-64 bg-blue-100/30 rounded-full blur-3xl -z-10"></div>
    <div class="fixed bottom-1/4 -right-20 w-80 h-80 bg-purple-100/30 rounded-full blur-3xl -z-10"></div>

    <script>
        function playPianoNote(pitch) {
            if (!pitch) return;
            const url = `https://gleitz.github.io/midi-js-soundfonts/FluidR3_GM/acoustic_grand_piano-mp3/${pitch}.mp3`;
            const audio = new Audio(url);
            audio.play().catch(e => console.error("Error piano:", e));
        }

        document.addEventListener('livewire:init', () => {
            Livewire.on('nextChallengeTimer', () => {
                setTimeout(() => {
                    @this.nextChallenge();
                }, 1500);
            });
            
            Livewire.on('playSuccessSound', (event) => {
                const pitch = event.pitch || (event[0] ? event[0].pitch : null);
                playPianoNote(pitch);
            });
            Livewire.on('playErrorSound', () => console.log('💨 Error!'));
        });
    </script>

    <style>
        @keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }
        @keyframes appear { 
            from { opacity: 0; transform: scale(0.9) translateY(40px); } 
            to { opacity: 1; transform: scale(1) translateY(0); } 
        }
        .animate-fade-in { animation: fade-in 0.5s ease-out; }
        .animate-appear { animation: appear 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
    </style>
</div>
