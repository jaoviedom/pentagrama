<div class="bg-white rounded-[3rem] p-8 shadow-xl border-b-8 border-purple-100">
    <div class="flex items-center gap-4 mb-8">
        <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center text-3xl shadow-inner">
            👤
        </div>
        <div>
            <h3 class="text-xl font-black text-gray-800">Mi Perfil</h3>
            <p class="text-sm font-bold text-purple-500 uppercase tracking-widest">Guardián Estelar</p>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-green-50 border-2 border-green-100 text-green-600 rounded-2xl text-sm font-bold animate-pulse">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="updateProfile" class="space-y-6">
        <div>
            <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Nombre Completo</label>
            <input type="text" wire:model="nombre_completo" 
                class="w-full px-6 py-4 bg-gray-50 border-2 border-gray-100 rounded-3xl focus:border-purple-400 focus:ring-0 transition-all font-bold text-gray-700">
            @error('nombre_completo') <span class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-2">ID de Usuario</label>
            <input type="text" value="{{ $username }}" disabled 
                class="w-full px-6 py-4 bg-gray-100 border-2 border-transparent rounded-3xl text-gray-400 font-bold cursor-not-allowed">
        </div>

        <button type="submit" 
            class="w-full bg-gray-800 hover:bg-black text-white font-black py-4 px-6 rounded-3xl transition-all shadow-lg hover:shadow-gray-200 active:scale-95 uppercase tracking-widest text-sm">
            Guardar Cambios ✨
        </button>
    </form>
</div>

