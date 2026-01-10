<div class="min-h-screen bg-[#FDFCF0] font-['Outfit',sans-serif]">
    
    @if($view === 'menu')
        <div class="max-w-6xl mx-auto p-4 md:p-8">
            <!-- Encabezado del Menú -->
            <header class="flex justify-between items-center mb-12 bg-white/60 backdrop-blur-md p-8 rounded-[3rem] border-4 border-white shadow-xl">
                <div>
                    <h1 class="text-5xl font-black text-gray-800 tracking-tight leading-none mb-2">Escuela Musical 🏫</h1>
                    <p class="text-gray-500 font-bold text-xl">¿Qué quieres aprender hoy?</p>
                </div>
                <a href="{{ route('game.selection') }}" class="bg-white hover:bg-gray-50 text-gray-600 p-5 rounded-[2rem] shadow-lg border-b-8 border-gray-200 active:border-b-0 active:translate-y-1 transition-all">
                    <span class="text-3xl">🏠</span>
                </a>
            </header>

            <!-- Grid de Opciones -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- 1. Biblioteca de Conceptos -->
                <button wire:click="setView('library')" class="group relative bg-gradient-to-br from-purple-500 to-indigo-600 p-1 rounded-[3rem] shadow-2xl transform hover:scale-105 transition-all">
                    <div class="bg-white rounded-[2.8rem] p-8 h-full flex flex-col items-center text-center group-hover:bg-transparent group-hover:text-white">
                        <div class="text-7xl mb-6 group-hover:animate-bounce">📖</div>
                        <h3 class="text-2xl font-black mb-2 group-hover:text-white">Biblioteca de Conceptos</h3>
                        <p class="text-gray-500 group-hover:text-white/80 font-medium">Los secretos del pentagrama y las claves</p>
                    </div>
                </button>

                <!-- 2. El Cuento de las Notas -->
                <button wire:click="setView('story')" class="group relative bg-gradient-to-br from-yellow-400 to-orange-500 p-1 rounded-[3rem] shadow-2xl transform hover:scale-105 transition-all">
                    <div class="bg-white rounded-[2.8rem] p-8 h-full flex flex-col items-center text-center group-hover:bg-transparent group-hover:text-white">
                        <div class="text-7xl mb-6 group-hover:animate-bounce">🎭</div>
                        <h3 class="text-2xl font-black mb-2 group-hover:text-white">El Cuento de las Notas</h3>
                        <p class="text-gray-500 group-hover:text-white/80 font-medium">Historias animadas para recordar</p>
                    </div>
                </button>

                <!-- 3. Entrenamiento de Oído -->
                <button wire:click="setView('ear-training')" class="group relative bg-gradient-to-br from-blue-400 to-cyan-500 p-1 rounded-[3rem] shadow-2xl transform hover:scale-105 transition-all">
                    <div class="bg-white rounded-[2.8rem] p-8 h-full flex flex-col items-center text-center group-hover:bg-transparent group-hover:text-white">
                        <div class="text-7xl mb-6 group-hover:rotate-12 transition-transform">👂</div>
                        <h3 class="text-2xl font-black mb-2 group-hover:text-white">Entrenamiento de Oído</h3>
                        <p class="text-gray-500 group-hover:text-white/80 font-medium">¡Afina tus orejas musicales!</p>
                    </div>
                </button>

                <!-- 4. Piano Libre -->
                <button wire:click="setView('piano')" class="group relative bg-gradient-to-br from-emerald-400 to-teal-500 p-1 rounded-[3rem] shadow-2xl transform hover:scale-105 transition-all">
                    <div class="bg-white rounded-[2.8rem] p-8 h-full flex flex-col items-center text-center group-hover:bg-transparent group-hover:text-white">
                        <div class="text-7xl mb-6 group-hover:animate-bounce">🎹</div>
                        <h3 class="text-2xl font-black mb-2 group-hover:text-white">Piano Libre</h3>
                        <p class="text-gray-500 group-hover:text-white/80 font-medium">Toca tus propias melodías</p>
                    </div>
                </button>


            </div>
        </div>
    @elseif($view === 'library')
        <!-- Botón Volver -->
        <div class="p-4 md:p-8 max-w-6xl mx-auto -mb-16 relative z-10">
            <button wire:click="setView('menu')" class="bg-white hover:bg-gray-50 text-gray-800 px-6 py-3 rounded-2xl font-black shadow-lg border-b-4 border-gray-200 active:border-b-0 active:translate-y-1 transition-all flex items-center gap-2">
                ⬅️ VOLVER AL MENÚ
            </button>
        </div>
        @livewire('game.lessons-library')
    @elseif($view === 'story')
        <!-- Botón Volver -->
        <div class="p-4 md:p-8 max-w-6xl mx-auto -mb-16 relative z-10">
            <button wire:click="setView('menu')" class="bg-white hover:bg-gray-50 text-gray-800 px-6 py-3 rounded-2xl font-black shadow-lg border-b-4 border-gray-200 active:border-b-0 active:translate-y-1 transition-all flex items-center gap-2">
                ⬅️ VOLVER AL MENÚ
            </button>
        </div>
        @livewire('game.note-story')
    @elseif($view === 'ear-training')
        <!-- Botón Volver -->
        <div class="p-4 md:p-8 max-w-6xl mx-auto -mb-16 relative z-10">
            <button wire:click="setView('menu')" class="bg-white hover:bg-gray-50 text-gray-800 px-6 py-3 rounded-2xl font-black shadow-lg border-b-4 border-gray-200 active:border-b-0 active:translate-y-1 transition-all flex items-center gap-2">
                ⬅️ VOLVER AL MENÚ
            </button>
        </div>
        @livewire('game.ear-training')
    @elseif($view === 'piano')
        <!-- Botón Volver -->
        <div class="p-4 md:p-8 max-w-6xl mx-auto -mb-16 relative z-10">
            <button wire:click="setView('menu')" class="bg-white hover:bg-gray-50 text-gray-800 px-6 py-3 rounded-2xl font-black shadow-lg border-b-4 border-gray-200 active:border-b-0 active:translate-y-1 transition-all flex items-center gap-2">
                ⬅️ VOLVER AL MENÚ
            </button>
        </div>
        @livewire('game.free-piano')
    @endif

</div>
