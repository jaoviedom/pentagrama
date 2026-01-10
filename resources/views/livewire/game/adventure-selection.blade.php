<div class="min-h-screen bg-[#FDFCF0] font-['Outfit',sans-serif] flex items-center justify-center p-4">
    <div class="max-w-4xl w-full">
        <!-- Saludo Inicial -->
        <div class="text-center mb-12 animate-fade-in-down">
            <div class="inline-block p-6 rounded-full bg-white shadow-xl mb-6 border-8" style="background-color: {{ $player->color }}; border-color: {{ $player->color }}88">
                <span class="text-8xl">{{ $player->avatar }}</span>
            </div>
            <h1 class="text-5xl font-black text-gray-800 tracking-tight">¡Hola, {{ $player->nickname }}!</h1>
            <p class="text-2xl text-gray-500 font-bold mt-2">¿Qué aventura quieres vivir hoy?</p>
        </div>

        <!-- Botones de Selección -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Opción: Estudiar / Lecciones -->
            <button wire:click="goToLessons" 
                class="group relative bg-gradient-to-br from-purple-500 to-indigo-600 p-2 rounded-[3.5rem] shadow-2xl transform hover:scale-105 transition-all duration-300">
                <div class="bg-white rounded-[3rem] p-10 h-full flex flex-col items-center text-center group-hover:bg-transparent transition-colors">
                    <div class="text-9xl mb-8 transform group-hover:rotate-12 transition-transform duration-500">📚</div>
                    <h3 class="text-4xl font-black mb-4 group-hover:text-white">Mis Lecciones</h3>
                    <p class="text-xl text-gray-500 group-hover:text-white/80 font-bold">
                        Aprende sobre el pentagrama, las notas y sus secretos musicales.
                    </p>
                    <div class="mt-8 px-8 py-3 bg-purple-100 text-purple-600 rounded-2xl group-hover:bg-white group-hover:text-purple-600 font-black uppercase tracking-widest transition-colors shadow-lg">
                        ¡QUIERO APRENDER! 📖
                    </div>
                </div>
            </button>

            <!-- Opción: Jugar / Mapa -->
            <button wire:click="goToPlay" 
                class="group relative bg-gradient-to-br from-yellow-400 to-orange-500 p-2 rounded-[3.5rem] shadow-2xl transform hover:scale-105 transition-all duration-300">
                <div class="bg-white rounded-[3rem] p-10 h-full flex flex-col items-center text-center group-hover:bg-transparent transition-colors">
                    <div class="text-9xl mb-8 transform group-hover:animate-bounce transition-transform duration-500">🎮</div>
                    <h3 class="text-4xl font-black mb-4 group-hover:text-white">¡A Jugar!</h3>
                    <p class="text-xl text-gray-500 group-hover:text-white/80 font-bold">
                        Supera niveles, gana estrellas y conviértete en un experto musical.
                    </p>
                    <div class="mt-8 px-8 py-3 bg-yellow-100 text-yellow-600 rounded-2xl group-hover:bg-white group-hover:text-yellow-600 font-black uppercase tracking-widest transition-colors shadow-lg">
                        ¡QUIERO JUGAR! 🏆
                    </div>
                </div>
            </button>
        </div>

        <!-- Botón Volver / Cambiar Jugador -->
        <div class="mt-16 text-center">
            <a href="{{ route('players.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-purple-600 font-black text-lg transition-colors group">
                <span class="bg-white p-3 rounded-2xl shadow-md border-b-4 border-gray-200 group-active:border-b-0 group-active:translate-y-1">👤 Cambiar de aventurero</span>
            </a>
        </div>
    </div>

    <style>
        @keyframes fade-in-down {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down { animation: fade-in-down 0.5s ease-out; }
    </style>
</div>
