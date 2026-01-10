<div class="min-h-screen bg-white/30 backdrop-blur-md rounded-[4rem] p-8 md:p-12 font-['Outfit',sans-serif] relative overflow-hidden flex flex-col items-center justify-center">
    
    @php $step = $story[$currentStep]; @endphp

    <div class="max-w-4xl w-full">
        <!-- Barra de Progreso Discreta -->
        <div class="flex gap-2 mb-12 justify-center">
            @foreach($story as $index => $s)
                <div class="h-2 w-16 rounded-full transition-all duration-500 {{ $index <= $currentStep ? 'bg-purple-500' : 'bg-gray-200' }}"></div>
            @endforeach
        </div>

        <!-- Escena del Cuento -->
        <div class="bg-white rounded-[4rem] shadow-2xl overflow-hidden border-b-[16px] border-purple-100 transform transition-all duration-700 hover:shadow-purple-200/50">
            <div class="flex flex-col md:flex-row min-h-[500px]">
                
                <!-- Parte Visual (Animación/Icono) -->
                <div class="md:w-1/2 bg-gradient-to-br {{ $step['bg'] }} p-12 flex items-center justify-center text-white relative">
                    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] mt-0"></div>
                    <div class="relative z-10 text-center">
                        <div class="text-[12rem] drop-shadow-[0_20px_20px_rgba(0,0,0,0.3)] animate-float-slow">
                            {{ $step['character'] }}
                        </div>
                        <div class="mt-8 text-7xl opacity-50">{{ $step['icon'] }}</div>
                    </div>
                </div>

                <!-- Parte Narrativa -->
                <div class="md:w-1/2 p-12 flex flex-col justify-between">
                    <div>
                        <h2 class="text-4xl font-black text-gray-800 mb-6 leading-tight">{{ $step['title'] }}</h2>
                        <p class="text-2xl text-gray-600 font-medium leading-relaxed italic">
                            "{{ $step['content'] }}"
                        </p>
                    </div>

                    <div class="flex gap-4 mt-12">
                        @if($currentStep > 0)
                            <button wire:click="prev" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-black py-6 rounded-3xl text-xl shadow-[0_8px_0_0_#D1D5DB] active:translate-y-2 active:shadow-none transition-all">
                                ATRÁS
                            </button>
                        @endif

                        <button wire:click="next" class="flex-[2] bg-purple-600 hover:bg-purple-500 text-white font-black py-6 rounded-3xl text-2xl shadow-[0_10px_0_0_#4C1D95] active:translate-y-2 active:shadow-none transition-all">
                            {{ $currentStep === $totalSteps - 1 ? '¡FIN DEL CUENTO! 🌈' : 'SIGUIENTE ✨' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes float-slow {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(5deg); }
        }
        .animate-float-slow { animation: float-slow 5s ease-in-out infinite; }
    </style>
</div>
