<x-layouts.app title="Seleccionar Jugador - Pentagrama">
    <div class="min-h-screen p-8 bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100">
        <!-- Botón de Cerrar Sesión (Padres/Profesores) -->
        <div class="max-w-7xl mx-auto flex justify-end mb-8">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-white/50 hover:bg-white text-gray-600 px-6 py-2 rounded-2xl font-bold transition-all border-b-4 border-gray-300 active:border-b-0 active:translate-y-1">
                    🔒 Salir (Padres)
                </button>
            </form>
        </div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Selección de Jugador -->
            <div class="lg:col-span-2">
                @livewire('players.select-player')
            </div>

            <!-- Crear Jugador -->
            <div class="lg:col-span-1">
                @livewire('players.create-player')
            </div>
        </div>
    </div>
</x-layouts.app>
