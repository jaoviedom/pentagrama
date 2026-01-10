<div class="bg-white rounded-3xl p-6 shadow-xl border-4 border-purple-200">
    <div class="flex items-center space-x-4 mb-6">
        <div class="bg-purple-100 p-3 rounded-full">
            <span class="text-3xl">👤</span>
        </div>
        <div>
            <h3 class="text-xl font-bold text-gray-800">Mi Perfil Mágico</h3>
            <p class="text-sm text-gray-500">Configura tu súper cuenta</p>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 border-2 border-green-300 text-green-700 rounded-xl text-sm font-bold flex items-center">
            <span>{{ session('message') }}</span>
        </div>
    @endif

    <form wire:submit.prevent="updateProfile" class="space-y-4">
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Tu Nombre</label>
            <input type="text" wire:model="nombre_completo" 
                class="w-full px-4 py-2 border-2 border-purple-100 rounded-xl focus:border-purple-400 focus:outline-none transition-all">
            @error('nombre_completo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Nombre de Usuario</label>
            <input type="text" value="{{ $username }}" disabled 
                class="w-full px-4 py-2 bg-gray-50 border-2 border-gray-100 rounded-xl text-gray-400 cursor-not-allowed">
        </div>

        <button type="submit" 
            class="w-full bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded-xl transition-colors shadow-lg">
            ¡Guardar Cambios! 🌟
        </button>
    </form>
</div>
