<div class="min-h-screen bg-sky-50 flex items-center justify-center p-4 font-['Outfit',sans-serif]">
    <div class="max-w-xl w-full">
        
        <!-- Contenedor Principal -->
        <div class="bg-white rounded-[4rem] shadow-2xl p-10 md:p-14 border-b-[16px] border-purple-100 relative overflow-hidden">
            
            <!-- Decoraciones de fondo -->
            <div class="absolute top-0 right-0 p-8 text-6xl opacity-10 animate-pulse">🎵</div>
            <div class="absolute bottom-0 left-0 p-8 text-6xl opacity-10 animate-bounce">🎹</div>

            <!-- Inicio de Sesión de Aventureros -->
            <div class="text-center animate-fade-in">
                <div class="text-6xl mb-4">✨</div>
                <h2 class="text-4xl font-black text-gray-800 mb-8 tracking-tight">¡Mundo Aventurero!</h2>

                @if (session()->has('error'))
                    <div class="bg-red-100 border-2 border-red-400 text-red-700 px-6 py-4 rounded-3xl mb-8 font-bold animate-shake">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="max-w-md mx-auto space-y-6 text-center">
                    <!-- Input Usuario -->
                    <div class="space-y-2 text-left">
                        <label class="ml-6 text-sm font-black text-purple-400 uppercase tracking-widest leading-none">Tu Nombre de Aventurero:</label>
                        <input type="text" 
                            wire:model="nicknameInput"
                            placeholder="Ej: SuperPianista"
                            class="w-full text-center text-3xl font-black py-5 px-6 bg-purple-50 border-4 border-purple-100 rounded-[2.5rem] focus:border-purple-500 focus:bg-white transition-all outline-none placeholder:text-purple-200"
                        >
                    </div>

                    <!-- Input PIN Visual -->
                    <div class="pt-2">
                        <label class="block text-sm font-black text-purple-400 uppercase tracking-widest mb-4">Tu PIN Secreto:</label>
                        <div class="flex justify-center gap-3">
                            @for ($i = 0; $i < 4; $i++)
                                <div class="w-12 h-12 md:w-14 md:h-14 rounded-2xl border-4 flex items-center justify-center text-2xl font-black transition-all duration-300 {{ strlen($pinInput) > $i ? 'bg-purple-600 border-purple-600 text-white translate-y-[-3px] shadow-lg' : 'bg-white border-gray-100 text-gray-200' }}">
                                    {{ strlen($pinInput) > $i ? '●' : '' }}
                                </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Teclado Numérico Compacto -->
                    <div class="grid grid-cols-3 gap-3 max-w-[280px] mx-auto pt-4">
                        @for ($i = 1; $i <= 9; $i++)
                            <button wire:click="addPinDigit({{ $i }})" class="h-14 bg-white border-2 border-gray-100 rounded-2xl text-2xl font-black text-gray-700 hover:bg-purple-600 hover:text-white hover:border-purple-600 transform active:scale-90 transition-all shadow-sm">
                                {{ $i }}
                            </button>
                        @endfor
                        <button wire:click="clearPin" class="h-14 bg-red-50 border-2 border-red-100 rounded-2xl text-xs font-black text-red-500 hover:bg-red-500 hover:text-white transform active:scale-90 transition-all shadow-sm uppercase">
                            Borrar
                        </button>
                        <button wire:click="addPinDigit(0)" class="h-14 bg-white border-2 border-gray-100 rounded-2xl text-2xl font-black text-gray-700 hover:bg-purple-600 hover:text-white hover:border-purple-600 transform active:scale-90 transition-all shadow-sm">
                            0
                        </button>
                        <button wire:click="login" class="h-14 bg-green-500 border-2 border-green-600 rounded-2xl text-xs font-black text-white hover:bg-green-600 transform active:scale-90 transition-all shadow-lg uppercase">
                            Ir 🚀
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- Volver -->
        <div class="mt-8 text-center">
            <a href="/" class="text-gray-400 font-bold hover:text-purple-600 transition-colors uppercase tracking-widest text-xs flex items-center justify-center gap-2">
                <span>🏠 Volver al Inicio</span>
            </a>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fade-in 0.4s ease-out; }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20% { transform: translateX(-5px); }
            40% { transform: translateX(5px); }
            60% { transform: translateX(-5px); }
            80% { transform: translateX(5px); }
        }
        .animate-shake { animation: shake 0.4s ease-in-out; }
    </style>
</div>
