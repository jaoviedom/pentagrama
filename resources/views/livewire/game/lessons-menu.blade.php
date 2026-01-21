<div class="min-h-screen bg-sky-50 font-['Outfit',sans-serif]">

    @if($view === 'menu')
        <div class="max-w-6xl mx-auto p-4 md:p-6">
            <!-- Encabezado del Menú -->
            <header
                class="flex justify-between items-center mb-6 bg-white/60 backdrop-blur-md p-6 rounded-[2.5rem] border-4 border-white shadow-xl">
                <div>
                    <h1 class="text-3xl font-black text-gray-800 tracking-tight leading-none mb-1">Escuela Musical 🏫</h1>
                    <p class="text-gray-500 font-bold text-lg">¿Qué quieres aprender hoy?</p>
                </div>
                <div class="flex gap-3">
                    <button wire:click="logout"
                        class="bg-red-50 hover:bg-red-100 text-red-500 p-4 rounded-3xl shadow-lg border-b-8 border-red-100 active:border-b-0 active:translate-y-1 transition-all"
                        title="Cerrar Sesión">
                        <span class="text-2xl">🚪</span>
                    </button>
                    <a href="{{ route('game.selection') }}"
                        class="bg-white hover:bg-gray-50 text-gray-600 p-4 rounded-3xl shadow-lg border-b-8 border-gray-200 active:border-b-0 active:translate-y-1 transition-all"
                        title="Inicio">
                        <span class="text-2xl">🏠</span>
                    </a>
                </div>
            </header>

            <!-- Grid de Opciones -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- 1. Biblioteca de Conceptos -->
                <button wire:click="setView('library')"
                    class="group relative bg-gradient-to-br from-purple-500 to-indigo-600 p-1 rounded-[2.5rem] shadow-2xl transform hover:scale-105 transition-all">
                    <div
                        class="bg-white rounded-[2.3rem] p-6 h-full flex flex-col items-center text-center group-hover:bg-transparent group-hover:text-white">
                        <div class="text-5xl mb-4 group-hover:animate-bounce">📖</div>
                        <h3 class="text-xl font-black mb-1 group-hover:text-white">Biblioteca</h3>
                        <p class="text-gray-500 group-hover:text-white/80 font-medium text-sm">Los secretos del pentagrama
                        </p>
                    </div>
                </button>

                <!-- 2. El Cuento de las Notas -->
                <button wire:click="setView('story')"
                    class="group relative bg-gradient-to-br from-yellow-400 to-orange-500 p-1 rounded-[2.5rem] shadow-2xl transform hover:scale-105 transition-all">
                    <div
                        class="bg-white rounded-[2.3rem] p-6 h-full flex flex-col items-center text-center group-hover:bg-transparent group-hover:text-white">
                        <div class="text-5xl mb-4 group-hover:animate-bounce">🎭</div>
                        <h3 class="text-xl font-black mb-1 group-hover:text-white">Cuento de Notas</h3>
                        <p class="text-gray-500 group-hover:text-white/80 font-medium text-sm">Historias para recordar</p>
                    </div>
                </button>

                <!-- 3. Entrenamiento de Oído -->
                <button wire:click="setView('ear-training')"
                    class="group relative bg-gradient-to-br from-blue-400 to-cyan-500 p-1 rounded-[2.5rem] shadow-2xl transform hover:scale-105 transition-all">
                    <div
                        class="bg-white rounded-[2.3rem] p-6 h-full flex flex-col items-center text-center group-hover:bg-transparent group-hover:text-white">
                        <div class="text-5xl mb-4 group-hover:rotate-12 transition-transform">👂</div>
                        <h3 class="text-xl font-black mb-1 group-hover:text-white">Oído Musical</h3>
                        <p class="text-gray-500 group-hover:text-white/80 font-medium text-sm">¡Afina tus orejas!</p>
                    </div>
                </button>

                <!-- 4. Piano Libre -->
                <button wire:click="setView('piano')"
                    class="group relative bg-gradient-to-br from-emerald-400 to-teal-500 p-1 rounded-[2.5rem] shadow-2xl transform hover:scale-105 transition-all">
                    <div
                        class="bg-white rounded-[2.3rem] p-6 h-full flex flex-col items-center text-center group-hover:bg-transparent group-hover:text-white">
                        <div class="text-5xl mb-4 group-hover:animate-bounce">🎹</div>
                        <h3 class="text-xl font-black mb-1 group-hover:text-white">Piano Libre</h3>
                        <p class="text-gray-500 group-hover:text-white/80 font-medium text-sm">Toca tus melodías</p>
                    </div>
                </button>


            </div>
        </div>
    @elseif($view === 'library')
        <!-- Botón Volver -->
        <div class="p-4 md:p-8 max-w-6xl mx-auto -mb-16 relative z-10">
            <button wire:click="setView('menu')"
                class="bg-white hover:bg-gray-50 text-gray-800 px-6 py-3 rounded-2xl font-black shadow-lg border-b-4 border-gray-200 active:border-b-0 active:translate-y-1 transition-all flex items-center gap-2">
                ⬅️ VOLVER AL MENÚ
            </button>
        </div>
        @livewire('game.lessons-library')
    @elseif($view === 'story')
        <!-- Botón Volver -->
        <div class="p-4 md:p-8 max-w-6xl mx-auto -mb-16 relative z-10">
            <button wire:click="setView('menu')"
                class="bg-white hover:bg-gray-50 text-gray-800 px-6 py-3 rounded-2xl font-black shadow-lg border-b-4 border-gray-200 active:border-b-0 active:translate-y-1 transition-all flex items-center gap-2">
                ⬅️ VOLVER AL MENÚ
            </button>
        </div>
        @livewire('game.note-story')
    @elseif($view === 'ear-training')
        <!-- Botón Volver -->
        <div class="p-4 md:p-8 max-w-6xl mx-auto -mb-16 relative z-10">
            <button wire:click="setView('menu')"
                class="bg-white hover:bg-gray-50 text-gray-800 px-6 py-3 rounded-2xl font-black shadow-lg border-b-4 border-gray-200 active:border-b-0 active:translate-y-1 transition-all flex items-center gap-2">
                ⬅️ VOLVER AL MENÚ
            </button>
        </div>
        @livewire('game.ear-training')
    @elseif($view === 'piano')
        <!-- Botón Volver -->
        <div class="p-4 md:p-8 max-w-6xl mx-auto -mb-16 relative z-10">
            <button wire:click="setView('menu')"
                class="bg-white hover:bg-gray-50 text-gray-800 px-6 py-3 rounded-2xl font-black shadow-lg border-b-4 border-gray-200 active:border-b-0 active:translate-y-1 transition-all flex items-center gap-2">
                ⬅️ VOLVER AL MENÚ
            </button>
        </div>
        @livewire('game.free-piano')
    @endif

</div>