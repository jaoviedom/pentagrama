<div class="min-h-screen bg-gradient-to-b from-blue-400 to-emerald-400 p-8 flex flex-col items-center justify-center">
    <div class="max-w-4xl w-full">
        <!-- Encabezado -->
        <div class="flex justify-between items-center mb-8 bg-white/20 backdrop-blur-md p-6 rounded-3xl border-4 border-white/30 text-white">
            <div>
                <h2 class="text-3xl font-black">Nivel {{ $level }}</h2>
                <p class="font-bold opacity-80">{{ $world === 'sol' ? 'Clave de Sol' : 'Clave de Fa' }}</p>
            </div>
            <a href="{{ route('game.map') }}" class="bg-white/20 hover:bg-white/40 p-4 rounded-2xl transition-all font-black border-b-4 border-white/40 active:border-b-0 active:translate-y-1">
                Salir 🚪
            </a>
        </div>

        <!-- Pentagrama Renderer -->
        <div class="mb-12">
            @livewire('staff-renderer', ['clef' => $world, 'activeNotes' => $currentNotes])
        </div>

        <!-- Controles -->
        <div class="text-center">
            @if(!$isPlaying)
                @if(session()->has('message'))
                    <div class="mb-8 p-8 bg-white rounded-[3rem] shadow-2xl animate-bounce">
                        <p class="text-4xl font-black text-purple-600 mb-4">{{ session('message') }}</p>
                        <a href="{{ route('game.map') }}" class="inline-block bg-gradient-to-r from-purple-500 to-pink-500 text-white font-black py-4 px-10 rounded-3xl text-2xl border-b-8 border-purple-800 transition-all active:border-b-0 active:translate-y-2">
                            Volver al Mapa 🗺️
                        </a>
                    </div>
                @else
                    <button wire:click="startLesson" class="bg-yellow-400 hover:bg-yellow-500 text-purple-900 font-black py-6 px-16 rounded-[2.5rem] text-4xl shadow-2xl border-b-8 border-yellow-600 transition-all transform hover:scale-105 active:border-b-0 active:translate-y-2">
                        🎮 ¡EMPEZAR!
                    </button>
                @endif
            @else
                <button wire:click="nextNote" class="bg-white hover:bg-gray-50 text-purple-600 font-black py-6 px-16 rounded-[2.5rem] text-4xl shadow-2xl border-b-8 border-gray-200 transition-all transform hover:scale-110 active:border-b-0 active:translate-y-2">
                    ¡Cantar Nota! 🎤
                </button>
                <p class="mt-8 text-white font-black text-xl animate-pulse">
                    Toca el botón cuando estés listo para la siguiente nota
                </p>
            @endif
        </div>
    </div>

    <!-- Sonidos (Simulados con JS o feedback visual) -->
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('playNoteSound', () => {
                // Aquí podrías añadir un sonido real
                console.log('¡Nota sonando!');
            });
        });
    </script>
</div>
