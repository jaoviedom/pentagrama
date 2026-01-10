<div 
    x-data="{
        playNote(pitch) {
            if (!pitch) return;
            const url = 'https://gleitz.github.io/midi-js-soundfonts/FluidR3_GM/acoustic_grand_piano-mp3/' + pitch + '.mp3';
            const audio = new Audio(url);
            audio.play().catch(e => console.warn('Audio blocked:', e));
        }
    }"
    x-on:play-pitches.window="$event.detail.pitches.forEach((p, i) => setTimeout(() => playNote(p), i * 600))"
    x-on:play-success-sound.window="playNote('C5'); setTimeout(() => playNote('E5'), 150); setTimeout(() => playNote('G5'), 300)"
    x-on:play-error-sound.window="playNote('Eb3')"
    class="min-h-[600px] flex flex-col items-center justify-center p-8 font-['Outfit',sans-serif]"
>
    
    @if($step === 'selection')
        <!-- Menú de Selección de Ejercicios -->
        <div class="max-w-4xl w-full text-center">
            <h2 class="text-5xl font-black text-gray-800 mb-4 leading-none">Entrenamiento de <span class="text-emerald-500">Oído</span></h2>
            <p class="text-gray-500 font-bold text-xl mb-12">¡Afina tus orejas musicales! 👂✨</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Ejercicio 1 -->
                <button wire:click="selectExercise('high_low')" class="group bg-white p-2 rounded-[3.5rem] shadow-2xl hover:scale-105 transition-all border-b-[12px] border-emerald-100 active:border-b-0 active:translate-y-2">
                    <div class="bg-emerald-50 rounded-[3rem] p-10 flex flex-col items-center">
                        <div class="text-8xl mb-6">🐦🐘</div>
                        <h3 class="text-3xl font-black text-gray-800 mb-2">Pajarito o Elefante</h3>
                        <p class="text-emerald-600 font-black uppercase text-sm tracking-widest">¿Es Agudo o Grave?</p>
                    </div>
                </button>

                <!-- Ejercicio 2 -->
                <button wire:click="selectExercise('up_down')" class="group bg-white p-2 rounded-[3.5rem] shadow-2xl hover:scale-105 transition-all border-b-[12px] border-blue-100 active:border-b-0 active:translate-y-2">
                    <div class="bg-blue-50 rounded-[3rem] p-10 flex flex-col items-center">
                        <div class="text-8xl mb-6">🧗🤿</div>
                        <h3 class="text-3xl font-black text-gray-800 mb-2">¿A dónde va?</h3>
                        <p class="text-blue-600 font-black uppercase text-sm tracking-widest">¿Sube o Baja?</p>
                    </div>
                </button>

                <!-- Ejercicio 3: Acordes -->
                <button wire:click="selectExercise('chords')" class="group bg-white p-2 rounded-[3.5rem] shadow-2xl hover:scale-105 transition-all border-b-[12px] border-orange-100 active:border-b-0 active:translate-y-2">
                    <div class="bg-orange-50 rounded-[3rem] p-10 flex flex-col items-center">
                        <div class="text-8xl mb-6">☀️☁️</div>
                        <h3 class="text-3xl font-black text-gray-800 mb-2">¿Feliz o Triste?</h3>
                        <p class="text-orange-600 font-black uppercase text-sm tracking-widest">Acordes Mayores/Menores</p>
                    </div>
                </button>
            </div>
        </div>

    @else
        <!-- Pantalla de Juego -->
        <div class="max-w-2xl w-full bg-white rounded-[4rem] shadow-2xl border-b-[16px] border-gray-100 p-12 text-center relative overflow-hidden">
            
            @if($gameState !== 'finished')
                <!-- Header del Juego -->
                <div class="flex justify-between items-center mb-12">
                    <button wire:click="resetGame" class="text-3xl hover:scale-110 transition-transform">🏠</button>
                    <div class="px-6 py-2 bg-gray-100 rounded-full font-black text-gray-500 uppercase text-xs tracking-widest">
                        Reto {{ $currentTrial }} de {{ $totalTrials }}
                    </div>
                    <div class="text-2xl font-black text-emerald-500">⭐ {{ $score }}</div>
                </div>

                <!-- Sonido -->
                <div class="mb-12">
                    <button wire:click="playAgain" class="group w-32 h-32 bg-emerald-500 rounded-full flex items-center justify-center shadow-[0_12px_0_0_#059669] hover:shadow-none hover:translate-y-2 transition-all mx-auto active:scale-95">
                        <span class="text-5xl group-hover:scale-110 transition-transform">🔊</span>
                    </button>
                    <p class="mt-6 text-xl font-bold text-gray-400">Escucha con atención...</p>
                </div>

                <!-- Opciones -->
                <div class="grid grid-cols-2 gap-6">
                    @foreach($options as $option)
                        <button 
                            wire:click="submitAnswer('{{ $option['id'] }}')"
                            @if($gameState === 'feedback') disabled @endif
                            class="group relative overflow-hidden p-8 rounded-[2.5rem] border-4 transition-all duration-300
                                {{ $gameState === 'feedback' && $option['id'] === $correctAnswer ? 'border-emerald-500 bg-emerald-50' : '' }}
                                {{ $gameState === 'feedback' && $option['id'] !== $correctAnswer ? 'border-gray-100 bg-gray-50 opacity-50' : 'border-gray-100 hover:border-emerald-300 hover:bg-emerald-50/30' }}
                            ">
                            <div class="text-6xl mb-4 transition-transform group-hover:scale-110">{{ $option['icon'] }}</div>
                            <div class="font-black text-gray-800 uppercase tracking-tight">{{ $option['label'] }}</div>
                            
                            @if($gameState === 'feedback' && $option['id'] === $correctAnswer)
                                <div class="absolute top-4 right-4 text-emerald-500 text-2xl font-bold">✅</div>
                            @endif
                        </button>
                    @endforeach
                </div>

                <!-- Footer de Feedback -->
                @if($gameState === 'feedback')
                    <div class="mt-12 animate-bounce">
                        <button wire:click="nextTrial" class="bg-purple-600 hover:bg-purple-500 text-white font-black px-12 py-6 rounded-3xl text-2xl shadow-[0_10px_0_0_#4C1D95] active:translate-y-2 active:shadow-none transition-all">
                            ¡CONTINUAR! 🚀
                        </button>
                    </div>
                @endif

            @else
                <!-- Pantalla de Resultados -->
                <div class="py-12">
                    <div class="text-[10rem] mb-8 animate-bounce">🏆</div>
                    <h2 class="text-5xl font-black text-gray-800 mb-4">¡Reto Superado!</h2>
                    <p class="text-2xl font-bold text-gray-500 mb-12">Conseguiste <span class="text-emerald-500 text-4xl">{{ $score }}</span> aciertos</p>
                    
                    <button wire:click="resetGame" class="bg-purple-600 hover:bg-purple-500 text-white font-black px-12 py-6 rounded-3xl text-2xl shadow-[0_10px_0_0_#4C1D95] active:translate-y-2 active:shadow-none transition-all">
                        VOLVER AL MENÚ 🏫
                    </button>
                </div>
            @endif
        </div>
    @endif

</div>
