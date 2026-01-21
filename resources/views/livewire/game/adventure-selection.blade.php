<div class="min-h-screen bg-sky-50 font-['Outfit',sans-serif] flex items-center justify-center p-4">
    <div class="max-w-4xl w-full">
        <!-- Saludo Inicial -->
        <div class="text-center mb-6 animate-fade-in-down">
            <div class="inline-block p-4 rounded-full bg-white shadow-xl mb-4 border-8"
                style="background-color: {{ $player->color }}; border-color: {{ $player->color }}88">
                <span class="text-5xl">{{ $player->avatar }}</span>
            </div>
            <h1 class="text-3xl font-black text-gray-800 tracking-tight">¡Hola, {{ $player->nickname }}!</h1>
            <p class="text-xl text-gray-500 font-bold mt-1">¿Qué aventura quieres vivir hoy?</p>
        </div>

        <!-- Botones de Selección -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Opción: Jugar / Mapa -->
            <button wire:click="goToLessons"
                class="group relative bg-gradient-to-br from-purple-500 to-indigo-600 p-1.5 rounded-[2.5rem] shadow-2xl transform hover:scale-105 transition-all duration-300">
                <div
                    class="bg-white rounded-[2.2rem] p-6 h-full flex flex-col items-center text-center group-hover:bg-transparent transition-colors">
                    <div class="text-6xl mb-4 transform group-hover:rotate-12 transition-transform duration-500">📚
                    </div>
                    <h3 class="text-2xl font-black mb-2 group-hover:text-white">Mis Lecciones</h3>
                    <p class="text-base text-gray-500 group-hover:text-white/80 font-bold">
                        Aprende sobre el pentagrama, las notas y sus secretos musicales.
                    </p>
                    <div
                        class="mt-4 px-6 py-2 bg-purple-100 text-purple-600 rounded-xl group-hover:bg-white group-hover:text-purple-600 font-black uppercase tracking-widest text-sm transition-colors shadow-lg">
                        ¡QUIERO APRENDER! 📖
                    </div>
                </div>
            </button>

            <!-- Opción: Jugar / Mapa -->
            <button wire:click="goToPlay"
                class="group relative bg-gradient-to-br from-yellow-400 to-orange-500 p-1.5 rounded-[2.5rem] shadow-2xl transform hover:scale-105 transition-all duration-300">
                <div
                    class="bg-white rounded-[2.2rem] p-6 h-full flex flex-col items-center text-center group-hover:bg-transparent transition-colors">
                    <div class="text-6xl mb-4 transform group-hover:animate-bounce transition-transform duration-500">🎮
                    </div>
                    <h3 class="text-2xl font-black mb-2 group-hover:text-white">¡A Jugar!</h3>
                    <p class="text-base text-gray-500 group-hover:text-white/80 font-bold">
                        Supera niveles, gana estrellas y conviértete en un experto musical.
                    </p>
                    <div
                        class="mt-4 px-6 py-2 bg-yellow-100 text-yellow-600 rounded-xl group-hover:bg-white group-hover:text-yellow-600 font-black uppercase tracking-widest text-sm transition-colors shadow-lg">
                        ¡QUIERO JUGAR! 🏆
                    </div>
                </div>
            </button>
        </div>

        <!-- Botón Volver / Cambiar Jugador -->
        <div class="mt-8 text-center flex flex-col md:flex-row items-center justify-center gap-4">
            <a href="{{ route('players.index') }}"
                class="inline-flex items-center gap-2 text-gray-400 hover:text-purple-600 font-black text-sm transition-colors group">
                <span
                    class="bg-white px-4 py-2 rounded-xl shadow-md border-b-4 border-gray-200 group-active:border-b-0 group-active:translate-y-1">👤
                    Cambiar aventurero</span>
            </a>

            <button wire:click="logout"
                class="inline-flex items-center gap-2 text-gray-400 hover:text-red-500 font-black text-sm transition-colors group">
                <span
                    class="bg-white px-4 py-2 rounded-xl shadow-md border-b-4 border-gray-200 group-active:border-b-0 group-active:translate-y-1">🚪
                    Salir</span>
            </button>
        </div>
    </div>

    <style>
        @keyframes fade-in-down {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.5s ease-out;
        }
    </style>
</div>