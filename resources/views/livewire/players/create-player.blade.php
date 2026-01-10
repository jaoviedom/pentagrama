<div class="bg-white rounded-3xl p-8 shadow-2xl border-b-8 border-purple-200">
    <div class="text-center mb-8">
        <h3 class="text-3xl font-black text-purple-600">✨ Nuevo Jugador ✨</h3>
        <p class="text-gray-500 font-bold">¡Crea tu personaje mágico!</p>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-green-100 border-b-4 border-green-300 text-green-700 rounded-2xl text-center font-bold animate-bounce">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-8">
        <!-- Nickname -->
        <div class="space-y-2">
            <label class="block text-xl font-black text-gray-700 text-center">📛 Tu Apodo</label>
            <input type="text" wire:model="nickname" 
                class="w-full text-center text-3xl px-6 py-4 bg-purple-50 border-4 border-purple-200 rounded-3xl focus:border-purple-400 focus:outline-none transition-all font-bold placeholder-purple-200"
                placeholder="Ej: Super Dino">
            @error('nickname') <p class="text-red-500 text-sm text-center font-bold">{{ $message }}</p> @enderror
        </div>

        <!-- Avatar Selection -->
        <div class="space-y-4">
            <label class="block text-xl font-black text-gray-700 text-center">🦁 Elige tu Avatar</label>
            <div class="grid grid-cols-4 gap-4">
                @foreach($avatars as $a)
                    <button type="button" wire:click="$set('avatar', '{{ $a }}')" 
                        class="text-5xl p-4 rounded-2xl transition-all transform hover:scale-110 {{ $avatar === $a ? 'bg-purple-500 shadow-lg scale-110' : 'bg-gray-100' }}">
                        {{ $a }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Color Selection -->
        <div class="space-y-4">
            <label class="block text-xl font-black text-gray-700 text-center">🎨 Tu Color Favorito</label>
            <div class="flex flex-wrap justify-center gap-4">
                @foreach($colors as $c)
                    <button type="button" wire:click="$set('color', '{{ $c }}')" 
                        class="w-12 h-12 rounded-full border-4 transition-all transform hover:scale-125 shadow-md {{ $color === $c ? 'border-white ring-4 ring-purple-300' : 'border-transparent' }}"
                        style="background-color: {{ $c }}">
                    </button>
                @endforeach
            </div>
        </div>

        <!-- PIN -->
        <div class="space-y-2">
            <label class="block text-xl font-black text-gray-700 text-center">🔑 Tu PIN Secreto (4 números)</label>
            <input type="password" wire:model.blur="pin" maxlength="4"
                class="w-full text-center text-3xl px-6 py-4 bg-yellow-50 border-4 border-yellow-200 rounded-3xl focus:border-yellow-400 focus:outline-none transition-all font-black tracking-widest">
            @error('pin') <p class="text-red-500 text-sm text-center font-bold">{{ $message }}</p> @enderror
        </div>

        <!-- Confirm PIN -->
        <div class="space-y-2">
            <label class="block text-xl font-black text-gray-700 text-center">✅ Confirma tu PIN</label>
            <input type="password" wire:model.blur="pin_confirmation" maxlength="4"
                class="w-full text-center text-3xl px-6 py-4 bg-green-50 border-4 border-green-200 rounded-3xl focus:border-green-400 focus:outline-none transition-all font-black tracking-widest">
            @error('pin_confirmation') <p class="text-red-500 text-sm text-center font-bold">{{ $message }}</p> @enderror
        </div>

        <!-- Submit -->
        <button type="submit" 
            class="w-full bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-black py-6 px-4 rounded-3xl transition-all transform hover:scale-105 shadow-xl text-2xl border-b-8 border-purple-800 active:border-b-0 active:translate-y-2">
            🚀 ¡LISTO PARA JUGAR!
        </button>
    </form>
</div>
