<div class="min-h-[400px]">
    @if($step === 'selection')
        <!-- Lista de Jugadores -->
        <div class="text-center mb-10">
            <h2 class="text-4xl font-black text-purple-600 mb-2">¿Quién va a jugar hoy?</h2>
            <p class="text-gray-500 font-bold text-xl">¡Toca tu personaje!</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-8">
            @foreach($players as $player)
                <button wire:click="selectPlayer({{ $player->id }})" 
                    class="group flex flex-col items-center space-y-4 transition-all transform hover:scale-110">
                    <div class="w-32 h-32 rounded-full flex items-center justify-center text-6xl shadow-2xl border-8 transition-colors group-hover:border-white ring-4 ring-transparent group-hover:ring-purple-300"
                        style="background-color: {{ $player->color }}; border-color: {{ $player->color }}88">
                        {{ $player->avatar }}
                    </div>
                    <span class="text-2xl font-black text-gray-800 bg-white px-4 py-1 rounded-full shadow-md group-hover:bg-purple-500 group-hover:text-white transition-colors">
                        {{ $player->nickname }}
                    </span>
                </button>
            @endforeach
        </div>

        @if(count($players) === 0)
            <div class="text-center py-20 px-8 bg-white/50 backdrop-blur-sm rounded-[3rem] border-4 border-dashed border-purple-200 animate-pulse">
                <div class="text-8xl mb-6">🎉</div>
                <h3 class="text-3xl font-black text-purple-600 mb-4">¡Bienvenido a Exploradores del Pentagrama!</h3>
                <p class="text-gray-500 font-bold text-lg mb-8 max-w-md mx-auto">
                    Aún no hay ningún aventurero musical. <br>
                    ¡Crea el primer personaje para empezar el viaje! 🚀
                </p>
                <div class="flex justify-center gap-4">
                    <span class="text-4xl animate-bounce">👉</span>
                    <span class="bg-purple-500 text-white px-6 py-2 rounded-full font-black uppercase text-sm">Usa el formulario de la derecha</span>
                </div>
            </div>
        @endif

    @else
        <!-- Teclado de PIN -->
        <div class="max-w-md mx-auto bg-white rounded-[3rem] p-10 shadow-2xl border-b-8 border-purple-200 animate-fade-in text-center">
            @php $currentSelected = $players->find($selectedPlayerId); @endphp
            
            <div class="mb-8">
                <div class="w-24 h-24 rounded-full mx-auto flex items-center justify-center text-5xl mb-4 shadow-xl"
                    style="background-color: {{ $currentSelected->color }}">
                    {{ $currentSelected->avatar }}
                </div>
                <h3 class="text-3xl font-black text-gray-800">¡Hola {{ $currentSelected->nickname }}!</h3>
                <p class="text-gray-500 font-bold">Pon tu código secreto</p>
            </div>

            @if (session()->has('error'))
                <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-2xl font-bold animate-shake">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Visores de PIN -->
            <div class="flex justify-center gap-4 mb-10">
                @for($i = 0; $i < 4; $i++)
                    <div class="w-12 h-16 rounded-2xl border-4 flex items-center justify-center text-3xl font-black {{ isset($pinInput[$i]) ? 'bg-purple-500 border-purple-600 text-white' : 'bg-gray-100 border-gray-200' }}">
                        {{ isset($pinInput[$i]) ? '●' : '' }}
                    </div>
                @endfor
            </div>

            <!-- Teclado Numérico -->
            <div class="grid grid-cols-3 gap-4 mb-8">
                @for($i = 1; $i <= 9; $i++)
                    <button wire:click="addPinDigit({{ $i }})" 
                        class="bg-purple-100 hover:bg-purple-200 text-purple-700 font-black text-3xl py-6 rounded-3xl transition-all transform active:scale-90 border-b-4 border-purple-300">
                        {{ $i }}
                    </button>
                @endfor
                <button wire:click="clearPin" class="bg-red-100 text-red-600 font-bold py-6 rounded-3xl border-b-4 border-red-200">
                    BORRAR
                </button>
                <button wire:click="addPinDigit(0)" class="bg-purple-100 hover:bg-purple-200 text-purple-700 font-black text-3xl py-6 rounded-3xl border-b-4 border-purple-300">
                    0
                </button>
                <button wire:click="cancelPin" class="bg-gray-100 text-gray-500 font-bold py-6 rounded-3xl border-b-4 border-gray-200">
                    ATRÁS
                </button>
            </div>
        </div>
    @endif
    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fade-in 0.3s ease-out; }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }
        .animate-shake { animation: shake 0.3s ease-in-out; }
    </style>
</div>
