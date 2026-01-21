<div class="min-h-screen bg-sky-50 p-4 md:p-8 font-['Outfit',sans-serif] overflow-hidden relative">
    <!-- Decoración de Fondo -->
    <div class="fixed top-20 -left-20 w-80 h-80 bg-purple-200/50 rounded-full blur-3xl -z-10 animate-pulse"></div>
    <div class="fixed bottom-20 -right-20 w-80 h-80 bg-yellow-100/50 rounded-full blur-3xl -z-10 bounce-slow"></div>

    <div class="max-w-6xl mx-auto">
        <!-- Encabezado Estilo Libro -->
        <header
            class="flex justify-between items-center mb-6 bg-white/60 backdrop-blur-md p-6 rounded-[2.5rem] border-4 border-white shadow-xl relative overflow-hidden">
            <div class="absolute inset-0 opacity-5"
                style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 20px 20px;"></div>
            <div class="relative z-10">
                <h1 class="text-3xl font-black text-gray-800 tracking-tight leading-none mb-1">Biblioteca de <span
                        class="text-purple-600">Conceptos</span></h1>
                <p class="text-gray-500 font-bold text-lg">¡Aprende los secretos de la música! 🪄🎼</p>
            </div>
            <a href="{{ route('game.selection') }}"
                class="relative z-10 bg-white hover:bg-gray-50 text-gray-600 p-4 rounded-3xl shadow-lg border-b-8 border-gray-200 active:border-b-0 active:translate-y-1 transition-all">
                <span class="text-2xl">🏠</span>
            </a>
        </header>

        <!-- Galería de Conceptos -->
        <div class="mb-8 flex flex-wrap justify-center gap-3">
            @foreach($categories as $cat)
                    <button wire:click="setCategory('{{ $cat }}')" class="px-6 py-2 rounded-xl font-black text-base transition-all border-b-6 shadow-lg
                            {{ $activeCategory === $cat
                ? 'bg-purple-600 border-purple-800 text-white -translate-y-1'
                : 'bg-white border-gray-100 text-gray-400 hover:border-gray-200 hover:text-purple-400' }}">
                        {{ $cat }}
                    </button>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12 min-h-[300px]">
            @foreach($this->filteredConcepts as $concept)
                <button wire:click="selectConcept('{{ $concept['id'] }}')"
                    class="group relative bg-gradient-to-br {{ $concept['bg'] }} p-1 rounded-[2.5rem] shadow-2xl transform hover:scale-105 transition-all duration-500 hover:-rotate-2">
                    <div
                        class="bg-white rounded-[2.3rem] p-6 h-full flex flex-col items-center text-center transition-colors group-hover:bg-transparent group-hover:text-white">
                        <div
                            class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center text-4xl mb-4 shadow-inner group-hover:bg-white/20 transition-colors">
                            {!! $concept['icon'] !!}
                        </div>
                        <h3 class="text-xl font-black mb-1 tracking-tight group-hover:text-white">{{ $concept['title'] }}
                        </h3>
                        <p class="text-gray-400 font-bold text-xs uppercase tracking-widest group-hover:text-white/80">
                            {{ $concept['subtitle'] }}</p>

                        <div
                            class="mt-4 bg-gray-100 group-hover:bg-white/20 px-4 py-2 rounded-full text-gray-500 group-hover:text-white font-black text-[10px] transition-colors">
                            DESCUBRIR ✨
                        </div>
                    </div>
                </button>
            @endforeach
        </div>

        <!-- El Lector de Conceptos (Modal Interactivo) -->
        @if($activeConcept)
            <div
                class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-purple-900/40 backdrop-blur-xl animate-fade-in">
                <div
                    class="bg-white max-w-3xl w-full rounded-[3rem] shadow-[0_20px_0_0_rgba(0,0,0,0.1)] border-b-[12px] border-purple-100 relative overflow-hidden flex flex-col md:flex-row">
                    <!-- Ilustración / Animación -->
                    <div
                        class="md:w-5/12 bg-gradient-to-br {{ $activeConcept['bg'] }} p-8 flex flex-col items-center justify-center text-white relative">
                        <div class="absolute top-4 left-4 text-4xl opacity-20">✨</div>
                        <div class="text-[8rem] drop-shadow-2xl animate-float">
                            {!! $activeConcept['icon'] !!}
                        </div>
                        <div class="mt-4 text-center">
                            <h4 class="text-2xl font-black mb-1">{{ $activeConcept['title'] }}</h4>
                            <p class="text-white/80 font-bold uppercase tracking-widest text-[10px]">
                                {{ $activeConcept['subtitle'] }}</p>
                        </div>
                    </div>

                    <!-- Contenido Explicativo -->
                    <div class="md:w-7/12 p-8 relative">
                        <button wire:click="closeConcept"
                            class="absolute top-4 right-4 w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center text-xl transition-all">
                            ✕
                        </button>

                        <div class="mb-6">
                            <span class="text-[10px] font-black text-purple-400 uppercase tracking-[0.3em] block mb-2">¿Qué
                                es esto?</span>
                            <p class="text-xl font-bold text-gray-700 leading-snug text-pretty">
                                {{ $activeConcept['description'] }}
                            </p>
                        </div>

                        <div class="bg-yellow-50 p-6 rounded-[2rem] border-2 border-yellow-100 relative overflow-hidden">
                            <div class="absolute -top-4 -right-4 text-4xl rotate-12 opacity-10">💡</div>
                            <span class="text-[8px] font-black text-yellow-600 uppercase tracking-widest block mb-1">Dato
                                Curioso</span>
                            <p class="text-base font-black text-yellow-800 leading-tight">
                                {{ $activeConcept['fact'] }}
                            </p>
                        </div>

                        <button wire:click="closeConcept"
                            class="mt-6 w-full bg-purple-600 hover:bg-purple-500 text-white font-black py-4 rounded-2xl text-xl shadow-[0_6px_0_0_#4C1D95] active:translate-y-1 active:shadow-none transition-all">
                            ¡LO ENTENDÍ! 🚀
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-float {
            animation: float 4s ease-in-out infinite;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out forwards;
        }

        .bounce-slow {
            animation: bounce 6s ease-in-out infinite;
        }
    </style>
</div>