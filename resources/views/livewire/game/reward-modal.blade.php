<div x-data="{ open: @entangle('show') }"
     x-show="open"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-purple-900/60 backdrop-blur-md"
     style="display: none;">
    
    @if($reward)
    <div x-show="open"
         x-transition:enter="transition ease-out duration-500 delay-100"
         x-transition:enter-start="opacity-0 scale-50 rotate-12"
         x-transition:enter-end="opacity-100 scale-100 rotate-0"
         class="bg-white rounded-[4rem] p-10 md:p-16 max-w-lg w-full text-center shadow-[0_20px_50px_rgba(0,0,0,0.3)] border-b-[16px] border-yellow-200 relative overflow-hidden">
        
        <!-- Rayos de luz animados detrás -->
        <div class="absolute inset-0 z-0 opacity-20 pointer-events-none">
            <div class="absolute inset-[-50%] bg-[conic-gradient(from_0deg,transparent,yellow,transparent)] animate-[spin_10s_linear_infinite]"></div>
        </div>

        <div class="relative z-10">
            <!-- Icono Grande -->
            <div class="text-[10rem] mb-6 drop-shadow-2xl animate-bounce">
                {{ $reward->icon }}
            </div>

            <!-- Título -->
            <h2 class="text-4xl font-black text-purple-600 mb-2 uppercase tracking-tight">
                ¡NUEVA RECOMPENSA!
            </h2>
            <h3 class="text-3xl font-black text-yellow-500 mb-6 drop-shadow-sm">
                {{ $reward->name }}
            </h3>

            <!-- Descripción -->
            <p class="text-xl font-bold text-gray-500 mb-10 leading-relaxed">
                {{ $reward->description }}
            </p>

            <!-- Botón de Acción -->
            <button wire:click="close" 
                    class="w-full bg-gradient-to-r from-yellow-400 to-orange-500 text-white font-black py-6 rounded-3xl text-2xl shadow-xl border-b-8 border-orange-700 transition-all hover:scale-105 active:translate-y-4 active:border-b-0">
                ¡GENIAL! 🚀
            </button>
        </div>
        
        <!-- Confeti (Simulado con micro-puntos de colores) -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            @for($i = 0; $i < 20; $i++)
                <div class="absolute w-3 h-3 rounded-full animate-ping opacity-60"
                     style="left: {{ rand(0, 100) }}%; top: {{ rand(0, 100) }}%; background-color: {{ ['#fbbf24', '#f87171', '#60a5fa', '#34d399'][rand(0, 3)] }}; animation-delay: {{ rand(0, 2000) }}ms;">
                </div>
            @endfor
        </div>
    </div>
    @endif

    <style>
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</div>
