<div class="relative min-h-screen bg-gray-50 flex flex-col">
    <!-- Navbar del Juego -->
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 p-4 border-b-4 border-purple-200">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-4">
                <button wire:click="logout"
                    class="bg-red-50 hover:bg-red-100 text-red-500 p-3 rounded-2xl transition-all border-b-4 border-red-200 active:border-b-0 active:translate-y-1"
                    title="Cerrar Sesión">
                    <span class="text-xl">🚪</span>
                </button>
                <a href="{{ route('game.selection') }}"
                    class="bg-gray-100 hover:bg-gray-200 p-3 rounded-2xl transition-all border-b-4 border-gray-300 active:border-b-0 active:translate-y-1"
                    title="Inicio">
                    🏠
                </a>
                <a href="{{ route('game.profile') }}"
                    class="flex items-center gap-3 bg-purple-100 px-4 py-2 rounded-2xl border-b-4 border-purple-300 hover:bg-purple-200 transition-all active:translate-y-1 active:border-b-0 group">
                    <span class="text-3xl group-hover:scale-110 transition-transform">{{ $player->avatar }}</span>
                    <span class="font-black text-purple-700 text-xl">{{ $player->nickname }}</span>
                </a>
                <a href="{{ route('game.trophies') }}"
                    class="flex items-center gap-2 px-4 h-12 bg-gradient-to-r from-purple-400 to-pink-400 text-white rounded-2xl font-black transition-all border-b-4 border-pink-600 hover:scale-105 active:border-b-0 active:translate-y-1 shadow-md text-sm tracking-tight"
                    title="Mi Cofre">
                    <span>🗃️</span>
                    <span>Cofre</span>
                </a>
            </div>

            <div class="flex gap-4 items-center">
                <a href="{{ route('game.speed-challenge', ['world' => $world]) }}"
                    class="hidden md:flex items-center gap-2 bg-gradient-to-r from-blue-400 to-indigo-400 text-white px-6 py-3 rounded-2xl font-black transition-all border-b-4 border-indigo-600 hover:scale-105 active:border-b-0 active:translate-y-1">
                    ⚡ Velocidad
                </a>
                <div class="flex gap-2">
                    <button wire:click="setWorld('sol')"
                        class="px-6 py-3 rounded-2xl font-black text-lg transition-all border-b-4 me-3 {{ $world === 'sol' ? 'bg-purple-500 text-white border-purple-700 scale-110 shadow-lg' : 'bg-white text-purple-500 border-purple-200 hover:bg-purple-50' }}">
                        🎼 Clave de Sol
                    </button>
                    <button wire:click="setWorld('fa')"
                        class="px-6 py-3 rounded-2xl font-black text-lg transition-all border-b-4 {{ $world === 'fa' ? 'bg-blue-500 text-white border-blue-700 scale-110 shadow-lg' : 'bg-white text-blue-500 border-blue-200 hover:bg-blue-50' }}">
                        𝄢 Clave de Fa
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Fondo de Mapa -->
    <div class="flex-1 relative overflow-hidden p-10 bg-gradient-to-b from-blue-50 to-green-50">
        <!-- Decoraciones aleatorias -->
        <div class="absolute top-10 left-10 text-6xl opacity-20 animate-bounce">☁️</div>
        <div class="absolute top-40 right-20 text-6xl opacity-20 animate-pulse">☁️</div>
        <div class="absolute bottom-20 left-1/4 text-6xl opacity-20">🎶</div>
        <div class="absolute top-1/4 right-1/4 text-6xl opacity-20 rotate-12">🎵</div>

        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-5xl font-black text-gray-800 mb-4 animate-fade-in-down">
                Mundo: <span
                    class="text-transparent bg-clip-text bg-gradient-to-r {{ $world === 'sol' ? 'from-purple-600 to-pink-500' : 'from-blue-600 to-cyan-500' }}">{{ $worldName }}</span>
            </h2>

            @if(session()->has('playing'))
                <div class="mb-8 p-6 bg-white rounded-3xl border-4 border-dashed border-yellow-400 animate-bounce">
                    <p class="text-2xl font-black text-yellow-600">{{ session('playing') }}</p>
                </div>
            @endif

            <!-- Mapa de Niveles -->
            <div class="grid grid-cols-2 md:grid-cols-5 gap-10 py-10">
                @foreach($levels as $level)
                            <div class="relative flex flex-col items-center">
                                <!-- Conexión visual (opcional/decorativa) -->
                                @if(!$loop->last)
                                    <div
                                        class="hidden md:block absolute top-10 -right-10 w-20 h-2 bg-gray-200 rounded-full z-0 overflow-hidden">
                                        <div class="h-full bg-gradient-to-r {{ $world === 'sol' ? 'from-purple-400 to-pink-300' : 'from-blue-400 to-cyan-300' }} transition-all duration-1000"
                                            style="width: {{ $level['is_completed'] ? '100' : '0' }}%"></div>
                                    </div>
                                @endif

                                <!-- Botón de Nivel -->
                                <button wire:click="playLevel({{ $level['level'] }})" {{ !$level['is_unlocked'] ? 'disabled' : '' }}
                                    class="relative z-10 w-24 h-24 rounded-3xl flex items-center justify-center text-3xl font-black transition-all transform hover:scale-110 active:scale-95 border-b-8 shadow-xl
                                                                {{ $level['is_unlocked']
                    ? ($level['is_completed']
                        ? ($world === 'sol' ? 'bg-purple-500 text-white border-purple-800' : 'bg-blue-500 text-white border-blue-800')
                        : 'bg-white text-gray-800 border-gray-200 hover:bg-gray-50')
                    : 'bg-gray-200 text-gray-400 border-gray-400 cursor-not-allowed opacity-70' }}">

                                    @if(!$level['is_unlocked'])
                                        🔒
                                    @else
                                        {{ $level['level'] }}
                                    @endif
                                </button>

                                <!-- Estrellas -->
                                @if($level['is_unlocked'])
                                    <div class="mt-4 flex gap-1">
                                        @for($i = 1; $i <= 3; $i++)
                                            <span
                                                class="text-2xl {{ $i <= $level['stars'] ? 'text-yellow-400 animate-pulse' : 'text-gray-300' }}">
                                                {{ $i <= $level['stars'] ? '★' : '☆' }}
                                            </span>
                                        @endfor
                                    </div>
                                @endif

                                <!-- Indicador de "Siguiente" -->
                                @if($level['is_unlocked'] && !$level['is_completed'])
                                    <div
                                        class="absolute -top-4 -right-2 bg-pink-500 text-white text-[10px] font-black px-2 py-1 rounded-full animate-bounce z-50 shadow-xl">
                                        ¡TOCA AQUÍ!
                                    </div>
                                @endif
                            </div>
                @endforeach
            </div>

            <!-- Sugerencia de Continuar -->
            @if($lastPlayed)
                <div
                    class="mt-12 bg-white/60 backdrop-blur-sm p-6 rounded-[2rem] border-4 border-white inline-flex items-center gap-6 shadow-xl animate-fade-in-up">
                    <div
                        class="bg-yellow-400 w-16 h-16 rounded-full flex items-center justify-center text-3xl shadow-lg border-b-4 border-yellow-600">
                        ⭐
                    </div>
                    <div class="text-left">
                        <p class="text-gray-500 font-bold">Última vez jugaste:</p>
                        <p class="text-xl font-black text-gray-800">
                            Nivel {{ $lastPlayed->level }}
                            ({{ $lastPlayed->world === 'sol' ? 'Clave de Sol' : 'Clave de Fa' }})
                        </p>
                    </div>
                    <button wire:click="setWorld('{{ $lastPlayed->world }}')"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-black px-8 py-3 rounded-2xl transition-all border-b-4 border-yellow-700 active:border-b-0 active:translate-y-1">
                        CONTINUAR 🚀
                    </button>
                </div>
            @endif
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

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.5s ease-out;
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.5s ease-out;
        }
    </style>
</div>