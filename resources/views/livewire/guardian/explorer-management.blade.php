<div class="space-y-8">
    <!-- Header de la sección -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white p-6 rounded-[2.5rem] shadow-xl border-b-4 border-purple-100">
        <div>
            <h2 class="text-3xl font-black text-purple-600">Exploradores Activos</h2>
            <p class="text-gray-500 font-medium">Gestiona y observa el progreso de tus pequeños músicos</p>
        </div>
        <button wire:click="openCreateModal" 
            class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-8 py-3 rounded-2xl font-black shadow-lg hover:shadow-purple-200 transform hover:scale-105 transition-all active:scale-95 flex items-center gap-2">
            <span>✨</span> Nuevo Explorador
        </button>
    </div>

    <!-- Mensajes de éxito -->
    @if (session()->has('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-xl animate-bounce-short">
            {{ session('success') }}
        </div>
    @endif

    <!-- Grid de Exploradores -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
        @forelse($players as $player)
            <div class="bg-white rounded-[3rem] p-8 shadow-xl border-b-8 border-purple-100 relative group transition-all hover:-translate-y-2">
                <div class="flex items-start justify-between mb-6">
                    <div class="w-20 h-20 bg-purple-50 rounded-3xl flex items-center justify-center text-5xl shadow-inner group-hover:scale-110 transition-transform">
                        {{ $player->avatar }}
                    </div>
                    <div class="flex gap-2">
                        <button wire:click="editPlayer({{ $player->id }})" class="p-2 hover:bg-gray-100 rounded-xl text-gray-400 hover:text-purple-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                        </button>
                        <button wire:click="confirmDelete({{ $player->id }})" class="p-2 hover:bg-red-50 rounded-xl text-gray-400 hover:text-red-500 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                </div>

                <h3 class="text-2xl font-black text-gray-800 mb-1">{{ $player->nickname }}</h3>
                <p class="text-purple-500 font-bold text-sm mb-6 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                    PIN: {{ $player->pin }}
                </p>

                <!-- Barra de Progreso -->
                <div class="space-y-2 mb-8">
                    <div class="flex justify-between text-sm font-black text-gray-400">
                        <span>PROGRESO</span>
                        <span class="text-purple-600">{{ $player->completed_lessons }} / {{ $totalLevels }}</span>
                    </div>
                    <div class="w-full h-4 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-purple-400 to-pink-500 transition-all duration-1000" 
                             style="width: {{ min(($player->completed_lessons / $totalLevels) * 100, 100) }}%"></div>
                    </div>
                </div>

            </div>
        @empty
            <div class="col-span-full bg-white/50 border-4 border-dashed border-gray-200 rounded-[3rem] p-12 text-center">
                <div class="text-6xl mb-4">🔦</div>
                <h3 class="text-xl font-bold text-gray-400 uppercase tracking-widest">No hay exploradores aún</h3>
                <p class="text-gray-400">¡Crea el primer perfil para comenzar la aventura!</p>
            </div>
        @endforelse
    </div>

    <!-- Modales -->
    @if($showCreateModal || $showEditModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-purple-900/60 backdrop-blur-md animate-fade-in">
            <div class="bg-white max-w-lg w-full rounded-[3rem] p-8 shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-purple-500 to-pink-500"></div>
                
                <h2 class="text-2xl font-black text-gray-800 mb-6">
                    {{ $showCreateModal ? '✨ Nuevo Explorador' : '📝 Editar Perfil' }}
                </h2>

                <form wire:submit.prevent="{{ $showCreateModal ? 'createPlayer' : 'updatePlayer' }}" class="space-y-6">
                    <div>
                        <label class="block text-sm font-black text-gray-400 uppercase tracking-widest mb-2">Nombre / Apodo</label>
                        <input wire:model="nickname" type="text" 
                            class="w-full px-6 py-4 bg-gray-50 border-2 border-gray-100 rounded-3xl focus:border-purple-400 focus:ring-0 transition-all font-bold"
                            placeholder="Ej. Juanito88">
                        @error('nickname') <span class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-black text-gray-400 uppercase tracking-widest mb-2">PIN Secreto (4 números)</label>
                        <input wire:model="pin" type="text" maxlength="4"
                            class="w-full px-6 py-4 bg-gray-50 border-2 border-gray-100 rounded-3xl focus:border-purple-400 focus:ring-0 transition-all font-mono font-bold tracking-widest text-center text-2xl"
                            placeholder="0000">
                        @error('pin') <span class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-black text-gray-400 uppercase tracking-widest mb-2">Elige un Avatar</label>
                        <div class="grid grid-cols-4 gap-4 max-h-48 overflow-y-auto p-2">
                            @foreach($avatars as $av)
                                <button type="button" wire:click="$set('avatar', '{{ $av }}')"
                                    class="w-12 h-12 flex items-center justify-center text-2xl rounded-2xl transition-all {{ $avatar === $av ? 'bg-purple-500 shadow-lg scale-110' : 'bg-gray-50 hover:bg-gray-100' }}">
                                    {{ $av }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button type="button" wire:click="closeModal"
                            class="flex-1 px-6 py-4 bg-gray-100 text-gray-500 rounded-3xl font-black hover:bg-gray-200 transition-colors">
                            CANCELAR
                        </button>
                        <button type="submit"
                            class="flex-1 px-6 py-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-3xl font-black shadow-lg hover:shadow-purple-200 transition-all">
                            {{ $showCreateModal ? 'CREAR 🚀' : 'GUARDAR ✨' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Confirmación de Eliminación -->
    @if($confirmingDeletion)
        <div class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm animate-fade-in">
            <div class="bg-white max-w-sm w-full rounded-[3rem] p-8 text-center shadow-2xl">
                <div class="text-5xl mb-4">⚠️</div>
                <h2 class="text-xl font-black text-gray-800 mb-2">¿Estás seguro?</h2>
                <p class="text-gray-500 mb-8 font-medium">Esta acción no se puede deshacer y se perderá todo el progreso.</p>
                <div class="flex flex-col gap-3">
                    <button wire:click="deletePlayer" 
                        class="w-full px-6 py-4 bg-red-500 text-white rounded-3xl font-black hover:bg-red-600 transition-all">
                        SÍ, ELIMINAR 🗑️
                    </button>
                    <button wire:click="$set('confirmingDeletion', false)" 
                        class="w-full px-6 py-4 bg-gray-100 text-gray-500 rounded-3xl font-black hover:bg-gray-200 transition-all">
                        CANCELAR
                    </button>
                </div>
            </div>
        </div>
    @endif

    <style>
        @keyframes bounce-short {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        .animate-bounce-short {
            animation: bounce-short 2s ease-in-out infinite;
        }
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</div>
